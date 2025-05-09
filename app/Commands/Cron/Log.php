<?php

declare(strict_types=1);

namespace App\Commands\Cron;

use System\Cron\InterpolateInterface;
use System\Support\Facades\Query;

class Log implements InterpolateInterface
{
    public function interpolate(string $message, array $context = []): void
    {
        Query::table('cron')
            ->insert()
            ->values([
                'message'     => $message,
                'context'     => json_encode($context),
                'date_create' => now()->timestamp,
            ])
            ->execute();
    }
}
