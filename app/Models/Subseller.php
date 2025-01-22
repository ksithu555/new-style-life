<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subseller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'name',
        'email',
        'password',
        'photo',
        'phone',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}