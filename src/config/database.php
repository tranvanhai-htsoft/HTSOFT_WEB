<?php

function htsoft_env(string $key, ?string $default = null): ?string
{
    static $loaded = false;
    static $vars = [];

    if (!$loaded) {
        $envFile = dirname(__DIR__, 2) . '/.env';
        if (is_file($envFile)) {
            foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
                    continue;
                }
                [$k, $v] = explode('=', $line, 2);
                $vars[trim($k)] = trim($v);
            }
        }
        $loaded = true;
    }

    return $vars[$key] ?? getenv($key) ?: $default;
}

return [
    'host' => htsoft_env('DB_HOST', '127.0.0.1'),
    'name' => htsoft_env('DB_NAME', 'htsoft_web'),
    'user' => htsoft_env('DB_USER', 'root'),
    'pass' => htsoft_env('DB_PASS', ''),
];
