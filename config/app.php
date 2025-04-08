<?php

return [
    'BASEURL'           => $_ENV['BASEURL'] ?? 'http://localhost',
    'time_zone'         => 'Europe/Rome',
    'APP_KEY'           => $_ENV['APP_KEY'] ?? '',
    'ENVIRONMENT'       => $_ENV['ENVIRONMENT'] ?? $_ENV['APP_ENV'] ?? 'dev',
    'APP_DEBUG'         => $_ENV['APP_DEBUG'],

    'BCRYPT_ROUNDS'     => $_ENV['BCRYPT_ROUNDS'] ?? 12,
    'CONFIG_STORAGE'    => $_ENV['file'] ?? 'file',
];
