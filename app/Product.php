<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{

    public $timestamps = false;

    public function users() {
        return $this->belongsToMany('App\User', 'id');
    }

    public function product_cats() {
        return $this->belongsToMany('App\ProductCat', 'productcat_product');
    }
    public function product_tags() {
        return $this->belongsToMany('App\ProductTag', 'producttag_product');
    }
}
