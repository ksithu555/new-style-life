<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    protected $fillable = [
        'help_id',
        'name',
        'to',
        'from',
        'subject',
        'body',
        'img',
    ];
}