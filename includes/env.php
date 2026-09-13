<?php
// includes/env.php
// Minimal .env loader (no external dependency). Loads KEY=VALUE lines from
// the project root .env file into getenv()/$_ENV if not already set.

function load_env(string $path): void {
    static $loaded = false;
    if ($loaded || !is_file($path)) {
        return;
    }
    $loaded = true;

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
        $key = trim($key);
        $value = trim($value);
        if ($value !== '' && $value[0] === '"' && substr($value, -1) === '"') {
            $value = substr($value, 1, -1);
        }
        if ($key !== '' && getenv($key) === false && !isset($_ENV[$key])) {
            $_ENV[$key] = $value;
            // putenv() is disabled on some shared hosts (e.g. Hostinger, via
            // disable_functions) — guard the call so it never breaks loading.
            if (function_exists('putenv')) {
                @putenv("$key=$value");
            }
        }
    }
}

load_env(__DIR__ . '/../.env');

function env(string $key, ?string $default = null): ?string {
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return $_ENV[$key];
    }
    $value = getenv($key);
    return $value === false ? $default : $value;
}
