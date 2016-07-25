<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OtpController extends Controller
{
    //
    public function p_register() {
        $p_register = $request->get('mobile');
        $token = mt_rand(100000, 999999);
        $p_register = $token;
    }
}