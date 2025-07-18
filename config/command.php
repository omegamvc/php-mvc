<?php

use App\Commands\CronCommand;
use App\Commands\HelpCommand;
use System\Integrate\Console\ClearCacheCommand;
use System\Integrate\Console\ConfigCommand;
use System\Integrate\Console\MaintenanceCommand;
use System\Integrate\Console\MakeCommand;
use System\Integrate\Console\MigrationCommand;
use System\Integrate\Console\PackageDiscoveryCommand;
use System\Integrate\Console\RouteCacheCommand;
use System\Integrate\Console\RouteCommand;
use System\Integrate\Console\SeedCommand;
use System\Integrate\Console\ServeCommand;
use System\Integrate\Console\VendorImportCommand;
use System\Integrate\Console\ViewCommand;

return [
    'commands' => [
        ClearCacheCommand::$command,
        ConfigCommand::$command,
        CronCommand::$command,
        HelpCommand::$command,
        MaintenanceCommand::$command,
        MakeCommand::$command,
        MigrationCommand::$command,
        PackageDiscoveryCommand::$command,
        RouteCacheCommand::$command,
        RouteCommand::$command,
        SeedCommand::$command,
        ServeCommand::$command,
        VendorImportCommand::$command,
        ViewCommand::$command,
    ],
];
