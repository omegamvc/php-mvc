<?php

/**
 * Part of App (Omega Application) - Providers Package
 * php version 8.3
 *
 * @link      https://omegamvc.github.io
 * @author    Adriano Giovannini <agisoftt@gmail.com>
 * @copyright Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version   2.0.0
 */

declare(strict_types=1);

namespace App\Providers;

use Omega\Cache\Cache;
use Omega\Cache\Storage\ArrayStorage;
use Omega\Cache\Storage\FileStorage;
use Omega\Container\Provider\AbstractServiceProvider;
use Omega\Support\Facades\Config;

/**
 * Service provider for the cache system.
 *
 * This provider registers and configures the application's cache services,
 * including support for file-based and in-memory (array) storage drivers.
 * It initializes the cache manager, binds all supported drivers to the
 * container, and sets the default cache driver based on the
 * `CACHE_STORAGE` environment configuration.
 *
 * Drivers registered:
 * - `cache.file`  → File-based persistent storage
 * - `cache.array` → In-memory temporary storage
 * - `cache`       → Cache manager with access to all drivers
 *
 * @category  App
 * @package   Providers
 * @link      https://omegamvc.github.io
 * @author    Adriano Giovannini <agisoftt@gmail.com>
 * @copyright Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version   2.0.0
 */
class CacheServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
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

        $this->app->set('cache', function () use ($cache): Cache {
            $manager = new Cache();
            $manager->setDefaultDriver($this->app[$cache]);
            $manager->setDriver('file', $this->app['cache.file']);
            $manager->setDriver('array', $this->app['cache.array']);

            return $manager;
        });
    }
}
