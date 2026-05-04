<?php

namespace App\Models;

use App\Enums\ServiceIcon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

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
        'seo_title',
        'seo_description',
        'seo_og_image_url',
        'seo_robots',
    ];

    protected function casts(): array
    {
        return [
            'deliverables' => 'array',
            'process' => 'array',
            'tech_stack' => 'array',
            'is_featured' => 'boolean',
            'icon' => ServiceIcon::class,
        ];
    }
}
