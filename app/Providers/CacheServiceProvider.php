<?php

declare(strict_types=1);

namespace App\Providers;

use Omega\Cache\CacheManager;
use Omega\Cache\Storage\ArrayStorage;
use Omega\Cache\Storage\FileStorage;
use Omega\Integrate\ServiceProvider;
use Omega\Support\Facades\Config;

class CacheServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $config = Config::get('CACHE_STORAGE', 'file');
        $cache  = match (true) {
            $config === 'array' => 'cache.array',
            default             => 'cache.file',
        };

        $this->app->set(
            'cache.file',
            fn (): FileStorage => new FileStorage(cache_path(), 3_600)
        );

        $this->app->set(
            'cache.array',
            fn (): ArrayStorage => new ArrayStorage(3_600)
        );

        $this->app->set('cache', function () use ($cache): CacheManager {
            $manager = new CacheManager();
            $manager->setDefaultDriver($this->app[$cache]);
            $manager->setDriver('file', $this->app['cache.file']);
            $manager->setDriver('array', $this->app['cache.array']);

            return $manager;
        });
    }
}
