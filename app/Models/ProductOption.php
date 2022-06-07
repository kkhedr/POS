<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $fillable = ['id','color','stock','size','product_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function orders(){
        return $this->belongsTo(OrderCreate::class);
    }


}
