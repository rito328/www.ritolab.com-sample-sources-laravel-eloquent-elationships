<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $hidden = ['pivot'];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');

        return $this->belongsToMany('App\Models\Tag')->withPivot('created_at', 'updated_at');

        return $this->belongsToMany('App\Models\Tag')->withTimestamps();

        return $this->belongsToMany('App\Models\Tag')
            ->as('cng_name') // アクセスするpivot名の変更
            ->withPivot('id', 'created_at', 'updated_at');

        // post_id が 3 のタグ情報を取得する
        return $this->belongsToMany('App\Models\Tag')
            ->wherePivot('post_id', 3)
            ->withTimestamps();

        // post_id が 1 と 3 のタグ情報を取得する
        return $this->belongsToMany('App\Models\Tag')
            ->wherePivotIn('post_id', [1, 3])
            ->withTimestamps();

        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
