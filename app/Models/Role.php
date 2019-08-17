<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function members()
    {
        return $this->hasMany('App\Models\Member');
    }

    public function posts()
    {
        return $this->hasManyThrough('App\Models\Post', 'App\Models\Member');
    }
}
