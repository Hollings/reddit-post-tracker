<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{

    public function postwatcher()
    {
        return $this->belongsTo('App\PostWatcher');
    }
}
