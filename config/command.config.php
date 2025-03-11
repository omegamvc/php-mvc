<?php

return [
    'commands' => [
        App\Commands\HelpCommand::$command,
        App\Commands\CronCommand::$command,
        \System\Console\Commands\MakeCommand::$command,
        \System\Console\Commands\ServeCommand::$command,
        \System\Console\Commands\RouteCommand::$command,
        \System\Console\Commands\MigrationCommand::$command,
        \System\Console\Commands\SeedCommand::$command,
        \System\Console\Commands\ViewCommand::$command,
        \System\Console\Commands\MaintenanceCommand::$command,
        \System\Console\Commands\ConfigCommand::$command,
        \System\Console\Commands\PackageDiscoveryCommand::$command,
        \System\Console\Commands\ClearCacheCommand::$command,
        // more command here
    ],
];
