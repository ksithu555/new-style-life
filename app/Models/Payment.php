<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'id',
        'seller_id',
        'buyer_id',
        'order_id',
        'total_amount',
        'payment_method',
        'created_at',
        'updated_at',
    ];
}