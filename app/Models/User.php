<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Models\Order;
use App\Models\Thana;
use App\Models\District;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','phone_no','division_id','district_id','street_address','ip_address','email', 'password','remember_token','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function order()
   {
    $orders=Order::where('user_id',Auth::id())->get();
   }

   public function thana()
   {
     return $this->belongsTo(Thana::class);
   }public function district()
   {
     return $this->belongsTo(District::class);
   }
}
