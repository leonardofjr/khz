<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    public $timestamps = false;

    public function products() {
        return $this->belongsToMany('App\Product', 'id');

    }
}
