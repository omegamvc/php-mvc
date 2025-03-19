<?php

declare(strict_types=1);

namespace App\Kernels;

use System\Application\Application;
use System\Console\Kernel;
use Whoops\Handler\PlainTextHandler;
use Whoops\Run;

class Cli extends Kernel
{
    /** @var Run */
    private Run $run;

    /** @var PlainTextHandler */
    private PlainTextHandler $handler;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->app->bootedCallback(function () {
            /* @var PlainTextHandler $handler */
            $this->handler = $this->app->make('error.PlainTextHandler');

            /* @var Run $run */
            $this->run = $this->app->make('error.handle');
            $this->run
              ->pushHandler($this->handler)
              ->register();
        });
    }
}
