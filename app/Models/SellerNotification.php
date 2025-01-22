<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerNotification extends Model
{
    use HasFactory;
    protected $table = 'seller_notifications';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'id',
        'seller_id',
        'related_id',
        'message',
        'time',
        'seen',
        'created_at',
        'updated_at',
    ];
}
