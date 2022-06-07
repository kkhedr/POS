<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidSupllier extends Model
{
    use HasFactory;
    protected $fillable = ['id','sup_id','price','product_id'];

    public function sups(){
        return $this->hasMany(Supllier::class,'id','sup_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'id','product_id');
    }
}
