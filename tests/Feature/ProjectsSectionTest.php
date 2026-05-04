<?php

use App\Livewire\ProjectsSection;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('projects section renders project titles and subtitles from database', function () {
    Project::factory()->create([
        'title' => 'Fintech Admin Panel',
        'subtitle' => 'Filament-powered admin dashboard.',
        'featured' => true,
        'sort_order' => 1,
    ]);
    Project::factory()->create([
        'title' => 'Livewire Booking System',
        'subtitle' => 'Real-time reservation flow.',
        'sort_order' => 2,
    ]);

    Livewire::test(ProjectsSection::class)
        ->assertSee('Fintech Admin Panel')
        ->assertSee('Filament-powered admin dashboard.')
        ->assertSee('Livewire Booking System')
        ->assertSee('Real-time reservation flow.');
});

test('projects section includes all projects ordered by sort_order', function () {
    Project::factory()->create(['title' => 'Third Project', 'sort_order' => 3]);
    Project::factory()->create(['title' => 'First Project', 'sort_order' => 1]);
    Project::factory()->create(['title' => 'Second Project', 'sort_order' => 2]);

    $html = Livewire::test(ProjectsSection::class)->html();

    expect(strpos($html, 'First Project'))->toBeLessThan(strpos($html, 'Second Project'));
    expect(strpos($html, 'Second Project'))->toBeLessThan(strpos($html, 'Third Project'));
});

test('projects section renders without error when project has no main image', function () {
    Project::factory()->create(['sort_order' => 1]);

    Livewire::test(ProjectsSection::class)->assertStatus(200);
});

test('projects section renders empty grid when no projects exist', function () {
    $component = Livewire::test(ProjectsSection::class);

    expect($component->get('projects'))->toBeEmpty();
});
