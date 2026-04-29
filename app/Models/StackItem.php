<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StackItem extends Model
{
    protected $fillable = ['name', 'tag', 'level', 'primary', 'sort_order'];

    protected function casts(): array
    {
        return ['primary' => 'boolean'];
    }
}
