<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchanges extends Model
{
    public function images(){
        return $this->hasMany('App\Models\Images', 'key', 'id')->where('type', 'exchange');
    }
}
