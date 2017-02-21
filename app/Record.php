<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function game(){
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function match() {
        return $this->belongsTo('App\Match', 'match_id');
    }
}
