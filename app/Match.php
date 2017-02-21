<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function game() {
        return $this->belongsTo('App\Game', 'game_id');
    }
    public function records() {
        return $this->hasMany('App\Record');
    }
}
