<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function order_details() {
        return $this->belongsTo('App\Order');
    }

    public function shipment_address() {
        return $this->belongsTo('App\ShipmentAddress');
    }
}
