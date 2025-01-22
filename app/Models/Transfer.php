<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table='transfers';
    protected $fillable = [
        'id',
        'transfer_code',
        'seller_id',
        'shop_name',
        'commission',
        'seller_amount',
        'payment',
        'status',
        'start_date',
        'end_date',
        'transferred_at',
        'created_at',
        'updated_at',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }
}
