<?php

namespace App\Models;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'id',
        'user_id',
        'billing_id',
        'shipping_id',
        'payment_id',
        'total_price',
        'order_status',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function billing_address()
    {
        return $this->belongsTo(Checkout::class,'billing_id','id');
    }

    public function shipping_address()
    {
        return $this->belongsTo(Checkout::class,'shipping_id','id');
    }
    public function order_detail()
    {
        return $this->belongsTo(Order_detail::class,'order_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function order_details()
    {
        return $this ->hasMany(Order_detail::class);
    }
}
