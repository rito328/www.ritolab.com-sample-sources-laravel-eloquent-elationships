<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = ['pivot'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');

        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    public function feeds()
    {
        return $this->morphedByMany('App\Models\Feed', 'taggable');
    }
}
