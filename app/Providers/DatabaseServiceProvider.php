<?php

declare(strict_types=1);

namespace App\Providers;

use DI\DependencyException;
use DI\NotFoundException;
use Omega\Database\MyPDO;
use Omega\Database\MyQuery;
use Omega\Database\MySchema;
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
            MyPDO::class,
            fn () => new MyPDO($sqlDsn)
        );

        $this->app->set(
            MySchema\MyPDO::class,
            fn () => new MySchema\MyPDO($sqlDsn)
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
