<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'tag',
        'client',
        'role',
        'duration',
        'year',
        'featured',
        'challenge',
        'solution',
        'outcome',
        'tech',
        'sort_order',
        'seo_title',
        'seo_description',
        'seo_og_image_url',
        'seo_robots',
    ];

    protected function casts(): array
    {
        return [
            'tech' => 'array',
            'outcome' => 'array',
            'featured' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')
            ->singleFile()
            ->useDisk('cloudinary');

        $this->addMediaCollection('gallery')
            ->useDisk('cloudinary');
    }
}
