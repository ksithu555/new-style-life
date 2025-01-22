<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'name',
        'post_code',
        'prefecture_id',
        'city',
        'chome',
        'building',
        'room_no',
        'phone',
        'place',
        'default',
        'main_address',
        'created_at',
        'updated_at',
    ];

    function prefecture() {
        return $this->belongsTo(Prefecture::class);
    }
}