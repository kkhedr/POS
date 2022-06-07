<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id','discount','cust_id'];
     
    public function orders(){
        return $this->belongsTo(OrderCreate::class);
    }

    public function customers()
   {
    return $this->hasMany(Customer::class,'id','cust_id');
   }

}
