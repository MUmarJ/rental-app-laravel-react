<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Post extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'images', 'offer_start', 'offer_end',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'offer_start' => 'datetime',
        'offer_end' => 'datetime',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    // One To Many (inverse) posts relation with user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // One To Many (inverse) posts relation with categories
    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }
}
