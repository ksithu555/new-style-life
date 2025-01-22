<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id', 
        'acc_name', 
        'acc_no', 
        'card_type', 
        'expired_date', 
        'security_code', 
        'img'
    ];

}
