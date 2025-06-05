<?php

declare(strict_types=1);

namespace App\Commands\Cron;

use Omega\Cron\InterpolateInterface;
use Omega\Support\Facades\DB;

use function json_encode;
use function now;

class Log implements InterpolateInterface
{
    /**
     * {@inheritdoc}
     */
    public function interpolate(string $message, array $context = []): void
    {
        DB::table('cron')
            ->insert()
            ->values([
                'message'     => $message,
                'context'     => json_encode($context),
                'date_create' => now()->timestamp,
            ])
            ->execute();
    }
}
