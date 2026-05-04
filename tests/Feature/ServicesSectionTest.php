<?php

use App\Livewire\ServicesSection;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('services section renders service titles and subtitles from database', function () {
    Service::factory()->create([
        'title' => 'Web App Development',
        'subtitle' => 'Production Laravel apps.',
        'is_featured' => true,
        'sort_order' => 1,
    ]);
    Service::factory()->create([
        'title' => 'Backend & APIs',
        'subtitle' => 'The parts nobody sees.',
        'is_featured' => false,
        'sort_order' => 2,
    ]);

    Livewire::test(ServicesSection::class)
        ->assertSee('Web App Development')
        ->assertSee('Production Laravel apps.')
        ->assertSee('Backend & APIs')
        ->assertSee('The parts nobody sees.');
});

test('services section applies featured class to featured services', function () {
    Service::factory()->featured()->create(['sort_order' => 1]);
    Service::factory()->create(['sort_order' => 2]);

    $html = Livewire::test(ServicesSection::class)->html();

    expect(substr_count($html, 'featured'))->toBe(1);
});

test('services section renders display numbers from loop position', function () {
    Service::factory()->create(['sort_order' => 1]);
    Service::factory()->create(['sort_order' => 2]);

    Livewire::test(ServicesSection::class)
        ->assertSee('01')
        ->assertSee('02');
});

test('services section renders empty grid when no services exist', function () {
    Livewire::test(ServicesSection::class)
        ->assertDontSee('data-n');
});
