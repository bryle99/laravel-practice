<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // one to one relationship user => post
    public function post()
    {
        return $this->hasOne('App\Models\Post');
        // finds user_id by default
        // return $this->hasOne('Post', 'user_id');
        // to specify reference id column
    }

    // one to many relationship user => post
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    // many to many relationship user => role
    public function roles()
    {
        // return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');

        return $this->belongsToMany('App\Models\Role')->withPivot('created_at');
    }
}
