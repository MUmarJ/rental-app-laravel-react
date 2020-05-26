<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Offer extends Model
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'status',
    ];

    // One To Many (inverse)
    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function post_owner()
    {
        return $this->belongsTo('App\User', 'user_id')->using('App\Post');
    }

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
