<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

foreach ([
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Redirect Laravel's bootstrap cache to /tmp (Vercel filesystem is read-only)
$bootstrapCacheDir = '/tmp/bootstrap/cache';
foreach ([
    'APP_PACKAGES_CACHE' => $bootstrapCacheDir.'/packages.php',
    'APP_SERVICES_CACHE' => $bootstrapCacheDir.'/services.php',
    'APP_CONFIG_CACHE' => $bootstrapCacheDir.'/config.php',
    'APP_ROUTES_CACHE' => $bootstrapCacheDir.'/routes-v7.php',
    'APP_EVENTS_CACHE' => $bootstrapCacheDir.'/events.php',
] as $key => $path) {
    putenv("{$key}={$path}");
    $_ENV[$key] = $path;
    $_SERVER[$key] = $path;
}

// Copy pre-built packages manifest from deployment into /tmp on cold starts
$builtPackages = __DIR__.'/../bootstrap/cache/packages.php';
$tmpPackages = $bootstrapCacheDir.'/packages.php';
if (file_exists($builtPackages) && ! file_exists($tmpPackages)) {
    copy($builtPackages, $tmpPackages);
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "ERROR: " . $e->getMessage() . "\n\n";
    echo "FILE: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "TRACE:\n" . $e->getTraceAsString();
    exit;
}