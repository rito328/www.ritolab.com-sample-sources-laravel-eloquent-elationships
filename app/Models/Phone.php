<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
