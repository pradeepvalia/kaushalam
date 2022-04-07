<?php

namespace App\Models;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table='order_details';
    protected $fillable=['product_id','order_id','qty','total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
