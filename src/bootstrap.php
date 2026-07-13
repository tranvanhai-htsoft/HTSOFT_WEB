<?php

/**
 * Autoloader thủ công, không cần Composer — ánh xạ namespace Htsoft\Lib\Xxx
 * sang file src/lib/Xxx.php (viết trực tiếp, dễ hiểu cho người mới học PHP).
 */
spl_autoload_register(function (string $class): void {
    if (!str_starts_with($class, 'Htsoft\\')) {
        return;
    }

    $relative = substr($class, strlen('Htsoft\\'));
    $path = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($path)) {
        require $path;
    }
});
