<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCreate extends Model
{
    use HasFactory;
    protected $fillable = ['option_id','product_id','price','amount','order_id'];

    public function options(){
        return $this->hasMany(ProductOption::class,'id','option_id');
    }

    public function product(){
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function order(){
        return $this->hasMany(Order::class,'id','order_id');
    }
}
