<?php

use App\Settings\SeoSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('robots.txt returns text/plain with correct content', function () {
    $settings = app(SeoSettings::class);
    $settings->robots_txt = "User-agent: *\nAllow: /";
    $settings->save();

    $this->get('/robots.txt')
        ->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('User-agent: *', escape: false);
});

test('robots.txt content reflects settings changes', function () {
    $settings = app(SeoSettings::class);
    $settings->robots_txt = "User-agent: *\nDisallow: /admin/";
    $settings->save();

    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Disallow: /admin/', escape: false);
});
