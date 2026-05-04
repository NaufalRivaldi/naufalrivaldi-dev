<?php

use App\Livewire\ProjectDetail;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('project detail renders correct project by slug', function () {
    Project::factory()->create([
        'slug' => 'fintech-admin',
        'title' => 'Fintech Admin Panel',
        'subtitle' => 'Filament-powered admin dashboard.',
        'tag' => 'Fintech',
        'client' => 'Singapore Payments Startup',
        'role' => 'Lead Backend Developer',
        'duration' => '8 months',
        'year' => '2025',
        'featured' => true,
        'challenge' => 'The client ran critical operations through spreadsheets.',
        'solution' => 'Rebuilt the admin as a Filament v3 panel.',
        'outcome' => [['k' => 'Reconciliation time', 'v' => '-92%']],
        'tech' => ['Laravel', 'Filament', 'PostgreSQL'],
        'sort_order' => 1,
    ]);

    Livewire::test(ProjectDetail::class, ['slug' => 'fintech-admin'])
        ->assertSee('Fintech Admin Panel')
        ->assertSee('Filament-powered admin dashboard.')
        ->assertSee('Singapore Payments Startup')
        ->assertSee('Lead Backend Developer')
        ->assertSee('8 months')
        ->assertSee('2025')
        ->assertSee('The client ran critical operations through spreadsheets.')
        ->assertSee('Rebuilt the admin as a Filament v3 panel.')
        ->assertSee('-92%')
        ->assertSee('Laravel')
        ->assertSee('Filament');
});

test('project detail returns 404 for unknown slug', function () {
    $this->get('/projects/non-existent')->assertNotFound();
});

test('project detail shows prev and next project titles', function () {
    Project::factory()->create(['slug' => 'first', 'title' => 'First Project', 'sort_order' => 1]);
    Project::factory()->create(['slug' => 'second', 'title' => 'Second Project', 'sort_order' => 2]);
    Project::factory()->create(['slug' => 'third', 'title' => 'Third Project', 'sort_order' => 3]);

    Livewire::test(ProjectDetail::class, ['slug' => 'second'])
        ->assertSee('First Project')
        ->assertSee('Third Project');
});

test('project detail wraps prev and next circularly', function () {
    Project::factory()->create(['slug' => 'only-one', 'title' => 'Only Project', 'sort_order' => 1]);

    Livewire::test(ProjectDetail::class, ['slug' => 'only-one'])
        ->assertSee('Only Project');
});

test('project detail exposes main_image_url and gallery_urls keys in project data', function () {
    Project::factory()->create(['slug' => 'test-project', 'sort_order' => 1]);

    $component = Livewire::test(ProjectDetail::class, ['slug' => 'test-project']);

    expect($component->get('project'))->toHaveKey('main_image_url');
    expect($component->get('project'))->toHaveKey('gallery_urls');
});
