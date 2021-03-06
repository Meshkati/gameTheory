<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function records() {
        return $this->hasMany('App\Record');
    }
    public function matches() {
        return $this->hasMany('\App\Match');
    }
}
