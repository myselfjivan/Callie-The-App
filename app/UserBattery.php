<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBattery extends Model {

    //
    protected $table = 'battery';
    protected $fillable = ['status', 'isCharging', 'usbCharge', 'acCharge', 'level', 'batteryPct'];

}
