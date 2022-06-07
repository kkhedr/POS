<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOperation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'order_operations';
    protected $fillable = ['id','price','amount','product_id','order_id'];

    public function product()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}
