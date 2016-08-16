<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

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
     * This mutator automatically hashes the password.
     *
     * @var string
     */
    //public function setPasswordAttribute($value) {
    //    $this->attributes['password'] = \Hash::make($value);
    //}

    public function status() {
        return $this->hasMany('App\Status');
    }

    public function contacts() {
        return $this->hasMany('App\Contacts');
    }

    public function battery() {
        return $this->hasMany('App\UserBattery');
    }

    public function callLogs() {
        return $this->hasMany('App\UserCallLogs');
    }

}
