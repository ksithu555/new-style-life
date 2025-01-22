<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_code',
        'buyer_id',
        'total_qty',
        'total_amount',
        'sub_total_amount',
        'coupon_discount_amount',
        'coupon_used_seller_id',
        'coupon_used_product_id',
        'shipping_fee',
        'payment_type',
        'payment_approved',
        'created_at',
        'updated_at',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}