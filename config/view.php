<?php

declare(strict_types=1);

use Omega\Support\Path;

return [
    'VIEW_PATHS' => [
        Path::getPath('resources.views'),
    ],
    'VIEW_EXTENSIONS' => [
        '.template.php',
        '.php',
        '',
    ],
    'COMPILED_VIEW_PATH' => Path::getPath('storage.app.view'),
];
