<?php

namespace App\Models;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='cart';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
