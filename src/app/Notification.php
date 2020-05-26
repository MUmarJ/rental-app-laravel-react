<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Notification extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'title', 'description', 'image',
    ];

    // One To Many (inverse)
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // One To Many (inverse)
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
