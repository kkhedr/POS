<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name','salary'];

    public function emppaids(){
        return $this->belongsTo(Paidemp::class);
    }

//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }
}
