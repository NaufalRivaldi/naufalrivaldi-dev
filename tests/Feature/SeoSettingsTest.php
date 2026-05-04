<?php

use App\Settings\SeoSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('seo settings have default values', function () {
    $settings = app(SeoSettings::class);

    expect($settings->site_name)->toBe('Naufal Rivaldi')
        ->and($settings->default_title)->not->toBeEmpty()
        ->and($settings->twitter_card_type)->toBe('summary_large_image')
        ->and($settings->robots_txt)->toContain('User-agent: *');
});
