<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supllier extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','phone'];
    
    public function suppaids(){
        return $this->belongsTo(PaidSupllier::class);
    }

    public function purchases(){
        return $this->belongsTo(Purchase::class);
    }

    public function money(){
        return $this->belongsTo(money_sup::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
