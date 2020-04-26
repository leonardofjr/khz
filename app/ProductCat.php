<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'product_cat_id'
    ];
    public function products() {
        return $this->belongsToMany('App\Product', 'id');

    }
}
