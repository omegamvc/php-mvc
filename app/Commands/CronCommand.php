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

namespace App\Commands;

use App\Commands\Cron\Log;
use React\EventLoop\Loop;
use Omega\Console\Style\Style;
use Omega\Cron\Schedule;
use Omega\Integrate\Console\CronCommand as ConsoleCronCommand;
use Omega\Time\Now;

use function microtime;
use function round;

/**
 * Command-line interface for managing cron-related tasks.
 *
 * This class defines and handles three main cron operations:
 * - `cron`       → executes the main scheduler
 * - `cron:list`  → lists all registered cron jobs
 * - `cron:work`  → simulates a live cron execution every minute via terminal
 *
 * It extends the base `ConsoleCronCommand` provided by the Omega framework.
 *
 * @category  App
 * @package   Commands
 * @link      https://omegamvc.github.io
 * @author    Adriano Giovannini <agisoftt@gmail.com>
 * @copyright Copyright (c) 2024 - 2025 Adriano Giovannini (https://omegamvc.github.io)
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version   2.0.0
 */
class CronCommand extends ConsoleCronCommand
{
    /**
     * Available command patterns and their corresponding method handlers.
     *
     * @var array<int, array{pattern: string, fn: array{0: class-string<CronCommand>, 1: string}}>
     */
    public static array $command = [
        [
            'pattern' => 'cron',
            'fn'      => [self::class, 'main'],
        ], [
            'pattern' => 'cron:list',
            'fn'      => [self::class, 'list'],
        ], [
            'pattern' => 'cron:work',
            'fn'      => [self::class, 'work'],
        ],
    ];

    /**
     * CronCommand constructor.
     *
     * Initializes the base command and sets up the internal logging mechanism.
     *
     * @param array<int, string> $argv           The command-line arguments
     * @param array<string, mixed> $default_option Optional default options
     */
    public function __construct($argv, $default_option = [])
    {
        parent::__construct($argv, $default_option);

        $this->log = new Log();
    }

    /**
     * {@inheritdoc}
     */
    public function work(): void
    {
        $print = new Style("\n");
        $print
            ->push('Simulate Cron in terminal (every minute)')->textBlue()
            ->newLines(2)
            ->push('type ctrl+c to stop')->textGreen()->underline()
            ->out();

        Loop::addPeriodicTimer(60.00, function () {
            $clock = new Now();
            $print = new Style();
            $time  = $clock->year . '-' . $clock->month . '-' . $clock->day;

            $print
                ->push('Run cron at - ' . $time)->textDim()
                ->push(' ' . $clock->hour . ':' . $clock->minute . ':' . $clock->second);

            $watchStart = microtime(true);

            $this->getSchedule()->execute();

            $watchEnd = round(microtime(true) - $watchStart, 3) * 1000;
            $print
                ->repeat(' ', 34 - $print->length())
                ->push('-> ')->textDim()
                ->push($watchEnd . 'ms')->textYellow()
                ->out()
            ;
        });
    }

    /**
     * {@inheritdoc}
     */
    public function scheduler(Schedule $schedule): void
    {
        $schedule->call(function () {
            return [
                'code' => 200,
            ];
        })
        ->retry(2)
        ->justInTime()
        ->anonymously()
        ->setEventName('schedule.from.' . __CLASS__);
    }
}
