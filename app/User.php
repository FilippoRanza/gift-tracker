<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function purchases() {
        return $this->hasMany('App\Purchase');
    }

    public function contribution() {
        return $this->hasMany('App\Purchase');
    }


    public function gift_list() {
        return $this->hasMany('App\GiftList');
    }

    public function list_guest() {
        return $this->hasMany('App\GiftList');
    }

    public function user_debt() {
        return $this->hasMany('App\Debt');
    }

}
