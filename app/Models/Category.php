<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];
    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return asset('uploads/'.$this->image);
    }// end of getImagePathAttribute

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
