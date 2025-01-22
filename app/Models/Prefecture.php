<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    protected $table = 'prefectures';

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function buyerAddressed()
    {
        return $this->hasMany(BuyerAddress::class);
    }
}