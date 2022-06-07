<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class money_sup extends Model
{
    use HasFactory;
    protected $fillable = ['id','money','sup_id'];

    public function sups(){
        return $this->hasMany(Supllier::class,'id','sup_id');
    }
}
