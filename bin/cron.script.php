#!/usr/bin/env php
<?php

declare(strict_types=1);

use Omega\Integrate\Console\CliKernel;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// call CLI
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

$out = $app->make(CliKernel::class);

$handle = $out->handle(['cli', 'cron']);

exit($handle);