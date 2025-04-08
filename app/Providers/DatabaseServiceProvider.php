<?php

declare(strict_types=1);

namespace App\Providers;

use System\Container\Exception\DependencyResolutionException;
use System\Container\Exception\ServiceNotFoundException;
use System\Database\Connection;
use System\Database\Query\Query;
use System\Database\Schema\SchemaConnection;
use System\Database\Schema\Schema;
use System\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * @throws ServiceNotFoundException
     * @throws DependencyResolutionException
     */
    public function boot(): void
    {
        $configs = $this->app->get('config');
        $sql_dsn = [
            'host'           => $configs['DB_HOST'],
            'user'           => $configs['DB_USER'],
            'password'       => $configs['DB_PASS'],
            'database_name'  => $configs['DB_NAME'],
        ];

        $this->app->set('dsn.sql', $sql_dsn);

        $this->app->set(
            Connection::class,
            fn () => new Connection($sql_dsn)
        );

        $this->app->set(
            SchemaConnection::class,
            fn () => new SchemaConnection($sql_dsn)
        );

        $this->app->set(
            'Query',
            fn () => new Query($this->app->get(Connection::class))
        );

        $this->app->set(
            'Schema',
            fn () => new Schema($this->app->get(SchemaConnection::class))
        );
    }
}
