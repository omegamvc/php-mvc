<?php

declare(strict_types=1);

use App\Commands\CronCommand;
use App\Commands\HelpCommand;
use System\Integrate\Console\ClearCacheCommand;
use System\Integrate\Console\ConfigCommand;
use System\Integrate\Console\MaintenanceCommand;
use System\Integrate\Console\MakeCommand;
use System\Integrate\Console\MigrationCommand;
use System\Integrate\Console\PackageDiscoveryCommand;
use System\Integrate\Console\RouteCommand;
use System\Integrate\Console\SeedCommand;
use System\Integrate\Console\ServeCommand;
use System\Integrate\Console\ViewCommand;

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
