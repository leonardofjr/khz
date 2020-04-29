<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order_details() {
        return $this->hasMany('App\OrderDetails', 'product_id');
    }

    public function product_cats() {
        return $this->belongsToMany('App\ProductCat', 'cat_product');
    }
    public function product_tags() {
        return $this->belongsToMany('App\ProductTag', 'tag_product');
    }
}
