<?php

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('casts json columns to arrays', function () {
    $service = Service::create([
        'slug'                => 'test-service',
        'title'               => 'Test',
        'subtitle'            => 'Tagline',
        'overview'            => 'Overview.',
        'best_for'            => 'Startups',
        'engagement_duration' => '4–8 weeks',
        'deliverables'        => ['Item one', 'Item two'],
        'process'             => [['title' => 'Step 1', 'description' => 'Do this.']],
        'tech_stack'          => ['Laravel'],
        'icon'                => 'code',
        'is_featured'         => false,
        'sort_order'          => 1,
    ]);

    $fresh = $service->fresh();

    expect($fresh->deliverables)->toBeArray()
        ->and($fresh->process)->toBeArray()
        ->and($fresh->tech_stack)->toBeArray()
        ->and($fresh->is_featured)->toBeBool();
});

it('can list services', function () {
    Livewire::test(ListServices::class)->assertOk();
});

it('can render the create page', function () {
    Livewire::test(CreateService::class)->assertOk();
});

it('can create a service', function () {
    Livewire::test(CreateService::class)
        ->fillForm([
            'slug'                => 'new-service',
            'title'               => 'New Service',
            'subtitle'            => 'A short tagline.',
            'overview'            => 'Overview text here.',
            'best_for'            => 'Startups',
            'engagement_duration' => '4–8 weeks',
            'deliverables'        => ['Deliverable one', 'Deliverable two'],
            'process'             => [
                ['title' => 'Step 1', 'description' => 'Do this first.'],
            ],
            'tech_stack'  => ['Laravel', 'Filament'],
            'icon'        => 'code',
            'is_featured' => false,
            'sort_order'  => 5,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Service::where('slug', 'new-service')->exists())->toBeTrue();
});

it('can render the edit page with existing data', function () {
    $service = Service::create([
        'slug'                => 'edit-test',
        'title'               => 'Edit Test',
        'subtitle'            => 'Subtitle here.',
        'overview'            => 'Overview.',
        'best_for'            => 'Teams',
        'engagement_duration' => '4–8 weeks',
        'deliverables'        => ['Item'],
        'process'             => [['title' => 'Step', 'description' => 'Desc.']],
        'tech_stack'          => ['Laravel'],
        'icon'                => 'server',
        'is_featured'         => false,
        'sort_order'          => 2,
    ]);

    Livewire::test(EditService::class, ['record' => $service->id])
        ->assertOk()
        ->assertSchemaStateSet([
            'title'    => 'Edit Test',
            'subtitle' => 'Subtitle here.',
            'icon'     => 'server',
        ]);
});
