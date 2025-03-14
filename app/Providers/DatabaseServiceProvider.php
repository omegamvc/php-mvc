<?php

declare(strict_types=1);

namespace App\Providers;

use DI\DependencyException;
use DI\NotFoundException;
use System\Container\ServiceProvider\AbstractServiceProvider;
use System\Database\MyPDO;
use System\Database\MyQuery;
use System\Database\MySchema;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * @throws DependencyException
     * @throws NotFoundException
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
            MyPDO::class,
            fn () => new MyPDO($sql_dsn)
        );

        $this->app->set(
            MySchema\MyPDO::class,
            fn () => new MySchema\MyPDO($sql_dsn)
        );

        $this->app->set(
            'MyQuery',
            fn () => new MyQuery($this->app->get(MyPDO::class))
        );

        $this->app->set(
            'MySchema',
            fn () => new MySchema($this->app->get(MySchema\MyPDO::class))
        );
    }
}
