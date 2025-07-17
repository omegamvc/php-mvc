<?php

return [
    'MAIL_DRIVER'       => env('MAIL_DRIVER', 'smtp'),
    'MAIL_HOST'         => env('MAIL_HOST', '127.0.0.1'),
    'MAIL_PORT'         => env('MAIL_PORT', 2525),
    'MAIL_USERNAME'     => env('MAIL_USERNAME', null),
    'MAIL_PASSWORD'     => env('MAIL_PASSWORD', null),
    'MAIL_ENCRYPTION'   => env('MAIL_ENCRYPTION', null),
    'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', 'email@domainname.com'),
];
