<?php

namespace App\Api\V1\Controllers;

use App\Otp;
use App\User;
use App\Http\Requests;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class OtpController extends Controller {

    use Helpers;
    //
    public function p_register(Request $request) {

        $pregister = new Otp;

        $pregister->mobile = $request->get('mobile');
        $pregister->otp = str_random(8);

        if ($pregister->save())
            return $this->response->created();
        else
            return $this->response->error('could_not_register_number', 500);
    }

    public function p_verify(Request $request) {

        $enterdOtp = $request->get('otp');
        $enterdMobile = $request->get('mobile');

        $otps = \App\Otp::where('mobile', $enterdMobile)->get();
        foreach ($otps as $otp) {
            if ($enterdOtp == $otp->otp) {
                $otp->v_status = 1;
                if ($otp->save())
                    return $otp;
                else
                    echo $this->response->error('error_occured', 500);
            } else {
                return $this->response->error('wrong_otp', 500);
            }
        }
    }

}
