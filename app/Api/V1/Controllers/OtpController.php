<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Otp;
use App\User;
use App\Http\Requests;

class OtpController extends Controller
{
    //
    public function p_register(Request $request){
        
        $p_register = new Otp;
        
        $p_register = $request->get('mobile');
        $token = mt_rand(100000, 999999);
        $p_register->$token;
        if (pregister()->save($status))
            return $this->response->p_register();
        else
            return $this->response->error('could_not_create_status', 500);
    }
}