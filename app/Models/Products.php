<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function images(){
        return $this->hasMany('App\Models\Images', 'key', 'id')->where('type', 'product');
    }

    public function rate(){
        return $this->hasMany('App\Models\Rates', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function views(){
        return $this->hasMany('App\Models\Views', 'product_id', 'id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comments', 'product_id', 'id');
    }
}
