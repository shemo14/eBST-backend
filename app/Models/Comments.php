<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }
}
