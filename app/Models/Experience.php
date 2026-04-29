<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['idx', 'role', 'company', 'location', 'duration', 'sort_order'];
}
