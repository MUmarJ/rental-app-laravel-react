<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //One to Many relation with posts
    public function posts(){
        return $this->hasMany('App\Posts')
    }
}