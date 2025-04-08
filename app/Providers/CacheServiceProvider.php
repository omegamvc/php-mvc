<?php

declare(strict_types=1);

namespace App\Providers;

use System\Cache\CacheManager;
use System\Cache\Storage\ArrayStorage;
use System\Cache\Storage\FileStorage;
use System\Container\ServiceProvider\AbstractServiceProvider;
use System\Support\Facades\Config;

class CacheServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $config = Config::get('CACHE_STORAGE', 'file');
        $cache  = match (true) {
            $config === 'file'  => 'cache.file',
            $config === 'array' => 'cache.array',
            default             => 'cache.file',
        };

        $this->app->set(
            'cache.file',
            fn (): FileStorage => new FileStorage(get_storage_path('app/view/'), 3_600)
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
