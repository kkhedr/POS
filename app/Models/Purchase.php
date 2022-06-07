<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['id','color','stock','size','product_id','sup_id'];

    public function product(){
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function supplier(){
        return $this->hasMany(Supllier::class,'id','sup_id');
    }

}
