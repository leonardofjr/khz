<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{

    public function product() {
        return $this->belongsTo('App\Product');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function order() {
        return $this->belongsTo('App\Order');
    }
}
