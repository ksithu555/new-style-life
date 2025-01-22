<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'id',
        'user_id',
        'prefecture_id',
        'name',
        'email',
        'password',
        'zip_code',
        'city',
        'building',
        'room_no',
        'address',
        'chome',
        'phone',
        'photo',
        'created_at',
        'updated_at',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function buyerAddresses()
    {
        return $this->hasMany(BuyerAddress::class);
    }
}