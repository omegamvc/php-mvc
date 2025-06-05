<?php

declare(strict_types=1);

use App\Commands\CronCommand;
use App\Commands\HelpCommand;
use Omega\Integrate\Console\ClearCacheCommand;
use Omega\Integrate\Console\ConfigCommand;
use Omega\Integrate\Console\MaintenanceCommand;
use Omega\Integrate\Console\MakeCommand;
use Omega\Integrate\Console\MigrationCommand;
use Omega\Integrate\Console\PackageDiscoveryCommand;
use Omega\Integrate\Console\RouteCommand;
use Omega\Integrate\Console\SeedCommand;
use Omega\Integrate\Console\ServeCommand;
use Omega\Integrate\Console\ViewCommand;

return [
    'commands' => [
        HelpCommand::$command,
        CronCommand::$command,
        MakeCommand::$command,
        ServeCommand::$command,
        RouteCommand::$command,
        MigrationCommand::$command,
        SeedCommand::$command,
        ViewCommand::$command,
        MaintenanceCommand::$command,
        ConfigCommand::$command,
        PackageDiscoveryCommand::$command,
        ClearCacheCommand::$command,
        // more command here
    ],
];
