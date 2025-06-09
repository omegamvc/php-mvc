<?php

declare(strict_types=1);

use Omega\Support\Facades\Schedule;

Schedule::call(static function () {
    return [
        'code' => 200,
        'data' => 'hai',
    ];
})
    ->everyTenMinute()
    ->anonymously()
    ->setEventName('schedule.from.routes');
