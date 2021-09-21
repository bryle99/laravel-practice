<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $table = 'posts';
    // protected $primaryKey = 'id';

    protected $date = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'path'
    ];

    public $directory = '/images/';


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // polymorphic - one to many
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    // polymorphic - many to many
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    // scope
    public static function scopeLatestt($query)
    {
        return $query->orderBy('id', 'desc');
    }

    // accessor 
    public function getPathAttribute($value)
    {
        return $this->directory . $value;
    }
}
