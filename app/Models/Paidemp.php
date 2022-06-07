<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paidemp extends Model
{
    use HasFactory;
    protected $fillable = ['emp_id','money'];

    public function emps(){
        return $this->hasMany(Employee::class,'id','emp_id');
    }
}
