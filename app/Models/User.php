<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Auth;

use Config;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable;

  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      if (Auth::user()) {
        $user = Auth::user();
        $model->created_by = $user->id;
        // $model->updated_by = $user->id;
      }
    });
    // static::updating(function($model)
    // {
    //     $user = Auth::user();
    //     $model->updated_by = $user->id;
    // });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'role',
    'name',
    'shop_name',
    'email',
    'password',
    'user_photo',
    'address',
    'phone',
    'status',
    'gender',
    'email_verified_at',
    'created_by',

  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  // protected $casts = [
  //     'email_verified_at' => 'datetime',
  // ];


  public function authorizeRoles($roles)
  {
    if ($this->hasAnyRole($roles)) {
      return true;
    }
    abort(401, 'This action is unauthorized.');
  }

  public function hasAnyRole($roles)
  {
    if (is_array($roles)) {
      foreach ($roles as $role) {
        if ($this->hasRole($role)) {
          return true;
        }
      }
    } else {
      if ($this->hasRole($roles)) {
        return true;
      }
    }
    return false;
  }

  public function hasRole($role)
  {

    // if (!empty(auth()->user()->role)) {
    if (auth()->user()->role == $role) {
      return true;
    }
    // }

    return false;
  }

  public function seller()
  {
    return $this->hasOne(Seller::class);
  }

  public function buyer()
  {
    return $this->hasOne(Buyer::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class, 'seller_id');
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }
  public function subSeller()
  {
    return $this->hasOne(Seller::class, 'user_id', 'created_by');
  }
}