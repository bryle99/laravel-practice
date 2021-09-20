<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Polymorphic many to many inverse
    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany('App\Models\Video', 'taggable');
    }
}
