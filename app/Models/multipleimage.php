<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multipleimage extends Model
{
    use HasFactory;
    protected $table='multipleimage';
    protected $fillable=['product_id','image','sort'];
}
