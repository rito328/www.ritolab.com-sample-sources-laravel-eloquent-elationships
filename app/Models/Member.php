<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function phone()
    {
        return $this->hasOne('App\Models\Phone');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
