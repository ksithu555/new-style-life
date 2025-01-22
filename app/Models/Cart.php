<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'seller_id',
        'buyer_id',
        'quantity',
        'size',
        'color',
    ];

    function product() {
        return $this->belongsTo(Product::class);
    }

    function seller() {
        return $this->belongsTo(Seller::class, 'seller_id', 'user_id');
    }
    
    function buyer() {
        return $this->belongsTo(Buyer::class);
    }
}