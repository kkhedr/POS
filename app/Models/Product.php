<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $fillable = ['id','name','price','price_buy','discount','image','category_id','sup_id','product_type'];
    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return asset('uploads/products/'.$this->image);
    }// end of getImagePathAttribute

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options(){
        return $this->hasMany(ProductOption::class,'product_id','id');
    }

    public function order_operation()
    {
        return $this->belongsTo(OrderOperation::class);
    }

    public function orders(){
        return $this->belongsTo(OrderCreate::class,'id','product_id');
    }

    public function supplier_paid(){
        return $this->belongsTo(PaidSupllier::class);
    }

    public function supplier(){
        return $this->hasMany(Supllier::class,'id','sup_id');
    }

    public function purchases(){
        return $this->belongsTo(Purchase::class);
    }



}
