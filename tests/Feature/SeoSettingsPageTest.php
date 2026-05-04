<?php

use App\Filament\Pages\ManageSeoSettings;
use App\Models\User;
use App\Settings\SeoSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('seo settings page loads for authenticated admin', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(ManageSeoSettings::class)
        ->assertSuccessful();
});

test('seo settings can be updated via save action', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(ManageSeoSettings::class)
        ->set('data.site_name', 'My Portfolio')
        ->set('data.default_title', 'My Portfolio — Dev')
        ->set('data.default_description', 'A great developer.')
        ->set('data.default_og_image_url', '')
        ->set('data.twitter_handle', 'myhandle')
        ->set('data.twitter_card_type', 'summary_large_image')
        ->set('data.google_site_verification', '')
        ->set('data.robots_txt', "User-agent: *\nAllow: /")
        ->call('save')
        ->assertHasNoErrors();

    expect(app(SeoSettings::class)->site_name)->toBe('My Portfolio');
});
