<?php

declare(strict_types=1);

return [
    'VIEW_PATHS' => [
        DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
    ],
    'VIEW_EXTENSIONS' => [
        '.template.php',
        '.php',
        '',
    ],
    'COMPILED_VIEW_PATH' => DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR,
];
