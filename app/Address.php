<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function shipment_address() {
        return $this->hasOne('App\ShipmentAddress');
    }

    public function billing_address() {
        return $this->hasOne('App\BillingAddress');
    }
}
