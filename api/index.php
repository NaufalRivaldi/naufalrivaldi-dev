<?php

// Vercel's filesystem is read-only except /tmp.
// Make sure Laravel's writable dirs exist there.
$tmpDirs = ['/tmp/views', '/tmp/cache', '/tmp/sessions', '/tmp/logs'];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

require __DIR__ . '/../public/index.php';