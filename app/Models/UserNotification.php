<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;
    protected $table = 'user_notifications';
    protected $fillable = [
        'order_detail_id',
        'buyer_id',
        'title',
        'seen',
    ];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}