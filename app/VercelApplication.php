<?php

namespace App;

use Illuminate\Foundation\Application;

class VercelApplication extends Application
{
    protected function vercelCachePath(string $file): string
    {
        return '/tmp/bootstrap/cache/'.$file;
    }

    public function getCachedServicesPath(): string
    {
        return $this->vercelCachePath('services.php');
    }

    public function getCachedPackagesPath(): string
    {
        return $this->vercelCachePath('packages.php');
    }

    public function getCachedConfigPath(): string
    {
        return $this->vercelCachePath('config.php');
    }

    public function getCachedRoutesPath(): string
    {
        return $this->vercelCachePath('routes-v7.php');
    }

    public function getCachedEventsPath(): string
    {
        return $this->vercelCachePath('events.php');
    }
}
