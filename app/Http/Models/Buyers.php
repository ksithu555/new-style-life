<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'bank_name',
        'bank_acc_type',
        'bank_branch',
        'bank_acc_name',
        'bank_acc_no',
        'shop_name',
        'shop_logo',
        'shop_establish',
        'phone',
        'zip_code',
        'address',
        'url',
    ];
}
