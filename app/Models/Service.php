<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'overview',
        'best_for',
        'engagement_duration',
        'deliverables',
        'process',
        'tech_stack',
        'icon',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'deliverables' => 'array',
            'process'      => 'array',
            'tech_stack'   => 'array',
            'is_featured'  => 'boolean',
        ];
    }
}
