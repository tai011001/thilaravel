<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    protected $table='products';
    protected $fillable=['name','id_type','description','unit_price','promotion_price','image','unit','new'];
    protected $primaryKey = 'id';
    public function product_type(){
        return $this->belongsTo('App\ProductType','id_type','id');
    }
    public function bill_detail(){
        return $this->hasMany('App\BillDetail','id_product','id');
    }
}
