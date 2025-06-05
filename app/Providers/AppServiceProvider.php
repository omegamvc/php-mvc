<?php

declare(strict_types=1);

namespace App\Providers;

use App\Commands\Cron\Log;
use Omega\Cron\Schedule;
use Omega\Integrate\ServiceProvider;
use Omega\Security\Hashing\Argon2IdHasher;
use Omega\Security\Hashing\ArgonHasher;
use Omega\Security\Hashing\BcryptHasher;
use Omega\Security\Hashing\DefaultHasher;
use Omega\Security\Hashing\HashManager;
use Omega\Support\Facades\Config;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // error handle
        $this->app->set('error.handle', fn () => new Run());
        $this->app->set('error.PrettyPageHandler', fn () => new PrettyPageHandler());
        $this->app->set('error.PlainTextHandler', fn () => new PlainTextHandler());

        // register schedule to container
        $this->app->set('cron.log', fn (): Log => new Log());
        $this->app->set('schedule', fn (): Schedule => new Schedule(now()->timestamp, $this->app['cron.log']));

        // hash
        $this->registerHash();
    }

    private function registerHash(): void
    {
        $this->app->set('hash.bcrypt', function (): BcryptHasher {
            return (new BcryptHasher())
                ->setRounds(
                    Config::get('BCRYPT_ROUNDS', 12)
                );
        });
        $this->app->set('hash.argon', value: function (): ArgonHasher {
            return (new ArgonHasher())
                ->setMemory(1024)
                ->setTime(2)
                ->setThreads(2);
        });
        $this->app->set('hash.argon2id', fn (): Argon2IdHasher => new Argon2IdHasher());
        $this->app->set('hash.default', fn (): DefaultHasher => new DefaultHasher());

        $this->app->set('hash', function (): HashManager {
            $hash = new HashManager();
            $hash->setDefaultDriver($this->app['hash.bcrypt']);
            $hash->setDriver('bcrypt', $this->app['hash.bcrypt']);
            $hash->setDriver('argon', $this->app['hash.argon']);
            $hash->setDriver('argon2id', $this->app['hash.argon2id']);
            $hash->setDriver('default', $this->app['hash.default']);

            return $hash;
        });
    }
}
