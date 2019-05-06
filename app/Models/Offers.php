<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    public function product(){
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }

}
