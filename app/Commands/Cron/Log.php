<?php

/**
 * Part of App (Omega Application) - Commands Package
 * php version 8.3
 *
 * @link      https://omegamvc.github.io
 * @author    Adriano Giovannini <agisoftt@gmail.com>
 * @copyright Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version   2.0.0
 */

declare(strict_types=1);

namespace App\Commands\Cron;

use Omega\Cron\InterpolateInterface;
use Omega\Support\Facades\DB;

use function json_encode;
use function Omega\Time\now;

/**
 * Logger implementation for scheduled Cron events.
 *
 * This class provides a concrete implementation of the `InterpolateInterface` used by the Omega Cron system.
 * It stores log messages into the `cron` database table, including a JSON-encoded context and timestamp.
 *
 * It is primarily used to persist cron execution data for debugging, auditing, or monitoring purposes.
 *
 * @category   App
 * @package    Commands
 * @subpackage Log
 * @link       https://omegamvc.github.io
 * @author     Adriano Giovannini <agisoftt@gmail.com>
 * @copyright  Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version    2.0.0
 */
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
