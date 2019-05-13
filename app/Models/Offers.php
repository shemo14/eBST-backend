<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    public function product(){
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function exchange(){
        return $this->belongsTo('App\Models\Exchanges', 'offer_id', 'id');
    }

}
