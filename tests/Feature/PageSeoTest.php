<?php

use App\Models\Project;
use App\Models\Service;
use App\Settings\SeoSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('homepage has correct title tag from settings', function () {
    $settings = app(SeoSettings::class);
    $settings->default_title = 'Naufal Rivaldi — Test Title';
    $settings->save();

    $this->get('/')
        ->assertOk()
        ->assertSee('<title>Naufal Rivaldi — Test Title</title>', escape: false);
});

test('homepage has meta description from settings', function () {
    $settings = app(SeoSettings::class);
    $settings->default_description = 'My test description.';
    $settings->save();

    $this->get('/')
        ->assertOk()
        ->assertSee('name="description"', escape: false)
        ->assertSee('My test description.', escape: false);
});

test('homepage has og:title tag', function () {
    $settings = app(SeoSettings::class);
    $settings->default_title = 'OG Title Test';
    $settings->save();

    $this->get('/')
        ->assertOk()
        ->assertSee('og:title', escape: false)
        ->assertSee('OG Title Test', escape: false);
});

test('service detail page uses seo_title when set', function () {
    Service::factory()->create([
        'slug' => 'seo-test-service',
        'title' => 'Default Title',
        'subtitle' => 'Default subtitle',
        'seo_title' => 'Custom SEO Title for Service',
    ]);

    $this->get(route('service.detail', 'seo-test-service'))
        ->assertOk()
        ->assertSee('<title>Custom SEO Title for Service</title>', escape: false);
});

test('service detail page falls back to title when seo_title is null', function () {
    $settings = app(SeoSettings::class);
    $settings->site_name = 'Naufal Dev';
    $settings->save();

    Service::factory()->create([
        'slug' => 'seo-fallback-service',
        'title' => 'My Service',
        'subtitle' => 'Great service',
        'seo_title' => null,
    ]);

    $this->get(route('service.detail', 'seo-fallback-service'))
        ->assertOk()
        ->assertSee('<title>My Service — Naufal Dev</title>', escape: false);
});

test('service detail has canonical url tag', function () {
    Service::factory()->create(['slug' => 'canonical-service']);

    $this->get(route('service.detail', 'canonical-service'))
        ->assertOk()
        ->assertSee('rel="canonical"', escape: false)
        ->assertSee('/services/canonical-service', escape: false);
});

test('project detail page uses seo_title when set', function () {
    Project::factory()->create([
        'slug' => 'seo-test-project',
        'title' => 'Default Project',
        'subtitle' => 'Project subtitle',
        'seo_title' => 'Custom SEO Title for Project',
    ]);

    $this->get(route('project.detail', 'seo-test-project'))
        ->assertOk()
        ->assertSee('<title>Custom SEO Title for Project</title>', escape: false);
});

test('project detail has json-ld script with CreativeWork type', function () {
    Project::factory()->create(['slug' => 'jsonld-project']);

    $this->get(route('project.detail', 'jsonld-project'))
        ->assertOk()
        ->assertSee('application/ld+json', escape: false)
        ->assertSee('CreativeWork', escape: false);
});

test('service detail has json-ld script with Service type', function () {
    Service::factory()->create(['slug' => 'jsonld-service']);

    $this->get(route('service.detail', 'jsonld-service'))
        ->assertOk()
        ->assertSee('application/ld+json', escape: false)
        ->assertSee('"Service"', escape: false);
});

test('homepage has hreflang alternate links', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('hreflang="en"', escape: false)
        ->assertSee('hreflang="x-default"', escape: false);
});
