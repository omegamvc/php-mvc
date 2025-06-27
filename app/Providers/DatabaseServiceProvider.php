<?php

declare(strict_types=1);

namespace App\Providers;

use DI\DependencyException;
use DI\NotFoundException;
use Omega\Database\Connection;
use Omega\Database\Query\Query;
use Omega\Database\Schema\Schema;
use Omega\Database\Schema\SchemaConnection;
use Omega\Container\Provider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function boot(): void
    {
        $configs = $this->app->get('config');
        $sqlDsn  = [
            'host'           => $configs['DB_HOST'],
            'user'           => $configs['DB_USER'],
            'password'       => $configs['DB_PASS'],
            'database_name'  => $configs['DB_NAME'],
        ];

        $this->app->set('dsn.sql', $sqlDsn);

        $this->app->set(
            Connection::class,
            fn () => new Connection($sqlDsn)
        );

        $this->app->set(
            SchemaConnection::class,
            fn () => new SchemaConnection($sqlDsn)
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
