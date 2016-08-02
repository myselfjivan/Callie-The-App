<?php

namespace App\Api\V1\Controllers;

use App\Otp;
use App\User;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Exception;

class OtpController extends Controller {

    use Helpers;

    public function p_register(Request $request) {

        $pregister = new Otp;

        //check if user exists ? No - create one and generate OTP

        try {
            $pregister->mobile = $request->get('mobile');
            $enterdMobile = $request->get('mobile');
            $pregister->otp = str_random(8);
            if ($pregister->save())
                return $pregister;
            else
                return $this->response->error('error_could_not_register_number', 500);
        } catch (\PDOException $e) {

            //check if user exists ? Yes - Regenerate OTP

            try {
                $otps = \App\Otp::where('mobile', $enterdMobile)->get();
                foreach ($otps as $otp) {
                    $otp->otp = str_random(8);
                }
                if ($otp->save())
                    return $otp;
                else
                    return $this->response->error('error_could_not_register_number', 500);
            } catch (\PDOException $e) {
                return $e;
            }
        }
    }

    public function p_verify(Request $request) {

        $enterdOtp = $request->get('otp');
        $enterdMobile = $request->get('mobile');

        $otps = \App\Otp::where('mobile', $enterdMobile)->get();

        //check if user exists ? No - create one and generate api key

        try {
            $user = new User();
            foreach ($otps as $otp) {
                if ($enterdOtp == $otp->otp) {
                    if (30 > $otp->updated_at->diffInMinutes(Carbon::now())) {
                        $otp->v_status = 1;
                        if ($otp->save()) {
                            $user->mobile = $otp->mobile;
                            $user->v_status = 1;
                            $user->apikey = str_random(120);
                            $user->verified_at = Carbon::now();
                            if ($user->save()) {
                                return $user;
                            } else {
                                echo $this->response->error('error_adding_user', 500);
                            }
                        } else
                            echo $this->response->error('error_adding_user_otp', 500);
                    }else {
                        return $this->response->error('error_otp_expired', 500);
                    }
                } else {
                    return $this->response->error('error_wrong_otp', 500);
                }
            }
        } catch (\PDOException $e) {

            //check if user exists ? Yes - Regenerate api key, it will lead in destroying users existing session
            //so only one installation at a time -- problem solved

            try {
                $usersArray = $otps = \App\User::where('mobile', $enterdMobile)->get();
                foreach ($usersArray as $userSingle) {
                    if ($enterdOtp == $otp->otp) {
                        if (30 > $otp->updated_at->diffInMinutes(Carbon::now())) {
                            $userSingle->apikey = str_random(120);
                            if ($userSingle->save()) {
                                return $userSingle;
                            } else {
                                echo $this->response->error('error_updating_key', 500);
                            }
                        } else {
                            return $this->response->error('error_otp_expired', 500);
                        }
                    } else {
                        return $this->response->error('error_wrong_otp', 500);
                    }
                }
            } catch (\PDOException $e) {
                return $e;
            }
            return $e;
        }
    }

}
