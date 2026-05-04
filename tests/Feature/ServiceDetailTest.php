<?php

use App\Livewire\ServiceDetail;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('service detail renders correct service by slug', function () {
    Service::factory()->create([
        'slug' => 'web-apps',
        'title' => 'Web App Development',
        'subtitle' => 'Production Laravel apps, shipped without drama.',
        'overview' => 'End-to-end Laravel apps with clean architecture.',
        'best_for' => 'Startups needing a full product.',
        'engagement_duration' => '6–24 weeks',
        'icon' => 'code',
        'deliverables' => ['Laravel monolith', 'Filament admin panel'],
        'process' => [
            ['title' => 'Discovery', 'description' => 'Map your domain.'],
            ['title' => 'Build', 'description' => 'Ship in sprints.'],
        ],
        'tech_stack' => ['Laravel', 'Livewire'],
        'sort_order' => 1,
    ]);

    Livewire::test(ServiceDetail::class, ['slug' => 'web-apps'])
        ->assertSee('Web App Development')
        ->assertSee('Production Laravel apps, shipped without drama.')
        ->assertSee('End-to-end Laravel apps with clean architecture.')
        ->assertSee('Startups needing a full product.')
        ->assertSee('6–24 weeks')
        ->assertSee('Laravel monolith')
        ->assertSee('Filament admin panel')
        ->assertSee('Discovery')
        ->assertSee('Map your domain.')
        ->assertSee('Laravel')
        ->assertSee('Livewire');
});

test('service detail shows service number based on sort position', function () {
    Service::factory()->create(['slug' => 'first-service', 'sort_order' => 1]);
    Service::factory()->create(['slug' => 'second-service', 'sort_order' => 2]);

    Livewire::test(ServiceDetail::class, ['slug' => 'second-service'])
        ->assertSee('02');
});

test('service detail shows process step numbers from loop position', function () {
    Service::factory()->create([
        'slug' => 'web-apps',
        'process' => [
            ['title' => 'Discovery', 'description' => 'Step one.'],
            ['title' => 'Build', 'description' => 'Step two.'],
            ['title' => 'Launch', 'description' => 'Step three.'],
        ],
        'sort_order' => 1,
    ]);

    Livewire::test(ServiceDetail::class, ['slug' => 'web-apps'])
        ->assertSee('01 / step')
        ->assertSee('02 / step')
        ->assertSee('03 / step');
});

test('service detail links to prev and next services', function () {
    Service::factory()->create(['slug' => 'first', 'title' => 'First Service', 'sort_order' => 1]);
    Service::factory()->create(['slug' => 'second', 'title' => 'Second Service', 'sort_order' => 2]);
    Service::factory()->create(['slug' => 'third', 'title' => 'Third Service', 'sort_order' => 3]);

    Livewire::test(ServiceDetail::class, ['slug' => 'second'])
        ->assertSee('First Service')
        ->assertSee('Third Service');
});

test('service detail returns 404 for unknown slug', function () {
    $this->get('/services/non-existent')->assertNotFound();
});
