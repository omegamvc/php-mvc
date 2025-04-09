<?php

use App\Commands\CronCommand;
use App\Commands\HelpCommand;
use System\Console\Commands\ClearCacheCommand;
use System\Console\Commands\ConfigCommand;
use System\Console\Commands\MaintenanceCommand;
use System\Console\Commands\MakeCommand;
use System\Console\Commands\MigrationCommand;
use System\Console\Commands\PackageDiscoveryCommand;
use System\Console\Commands\RouteCommand;
use System\Console\Commands\SeedCommand;
use System\Console\Commands\ServeCommand;
use System\Console\Commands\ViewCommand;

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
    ],
];
