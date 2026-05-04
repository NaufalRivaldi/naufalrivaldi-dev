<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public string $site_name;

    public string $default_title;

    public string $default_description;

    public string $default_og_image_url;

    public string $twitter_handle;

    public string $twitter_card_type;

    public string $google_site_verification;

    public string $robots_txt;

    public static function group(): string
    {
        return 'seo';
    }
}
