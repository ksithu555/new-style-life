<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBankAccount extends Model
{
    use HasFactory;

    protected $table = 'cash_bank_accounts';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'transfer_person_name',
        'transfer_date',
        'bank_account_id'
    ];
}