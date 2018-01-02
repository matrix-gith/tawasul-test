<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public function post(){
        return $this->belongsTo('App\Post','feedable_id');
    }

    public function event(){
        return $this->belongsTo('App\Event','feedable_id');
    }
}
