<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $contact_email;

    public string $linkedin_url;

    public string $github_url;

    public string $twitter_url;

    public string $availability_status;

    public string $timezone;

    public static function group(): string
    {
        return 'general';
    }
}
