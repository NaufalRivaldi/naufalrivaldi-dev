<?php

use App\Models\Project;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('sitemap.xml returns xml with urlset', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee('<urlset', escape: false);
});

test('sitemap.xml includes homepage url', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertSee(url('/'), escape: false);
});

test('sitemap.xml includes service urls', function () {
    Service::factory()->create(['slug' => 'test-service-seo']);

    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertSee('/services/test-service-seo', escape: false);
});

test('sitemap.xml includes project urls', function () {
    Project::factory()->create(['slug' => 'test-project-seo']);

    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertSee('/projects/test-project-seo', escape: false);
});
