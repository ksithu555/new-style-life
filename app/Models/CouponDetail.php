<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDetail extends Model
{
    use HasFactory;
    protected $table = 'coupon_details';
    protected $fillable = [
        'buyer_id',
        'coupon_id',
        'order_id'
    ];
}