<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $casts = [
        'name' => 'string',
    ];
}
