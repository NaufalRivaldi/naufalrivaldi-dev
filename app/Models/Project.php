<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['slug', 'title', 'tag', 'desc', 'tech', 'featured', 'year', 'thumbnail_url', 'sort_order'];

    protected function casts(): array
    {
        return [
            'tech' => 'array',
            'featured' => 'boolean',
        ];
    }
}
