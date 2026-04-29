<?php

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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
