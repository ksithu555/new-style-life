<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use Config;

class UserRegister extends Model
{
    protected $table = 'Users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
}