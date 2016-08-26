<?php

namespace App\Api\V1\Controllers;

use App\Otp;
use App\User;
use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class OtpController extends Controller {

    use Helpers;

    public function p_register(Request $request) {
        $this->validate($request, [
            'mobile' => 'phone:US,BE,IN',
            'country_code' => 'required_with:mobile',
        ]);

        $pregister = new Otp;

        //check if user exists ? No - create one and generate OTP

        try {
            $pregister->mobile = $request->get('country_code') . $request->get('mobile');
            $enterdMobile = $request->get('country_code') . $request->get('mobile');
            $pregister->otp = str_random(6);
            $pregister->ip_address = $request->ip();
            $pregister->fingerprint = $request->fingerprint();
            $pregister->created_at = Carbon::now();
            $pregister->updated_at = Carbon::now();
            if ($pregister->save())
                //return $pregister;
                return response()->json(['message' => 'success', 'status_code' => '1']);
            else
                return response()->json(['message' => 'could_not_register_number', 'status_code' => '0']);
                //return $this->response->error('error_could_not_register_number', 500);
        } catch (\PDOException $e) {

            //check if user exists ? Yes - Regenerate OTP

            try {
                $otps = \App\Otp::where('mobile', $enterdMobile)->get();
                foreach ($otps as $otp) {
                    $otp->otp = str_random(6);
                    $pregister->ip_address = $request->ip();
                    $pregister->fingerprint = $request->fingerprint();
                    $otp->updated_at = Carbon::now();
                }
                if ($otp->save())
                    //return $otp;
                    return response()->json(['message' => 'success', 'status_code' => '1']);
                else
                    return response()->json(['message' => 'could_not_register_number', 'status_code' => '0']);
                    //return $this->response->error('error_could_not_register_number', 500);
            } catch (\PDOException $e) {
                return $e;
            }
        }
    }

    public function p_verify(Request $request) {

        $this->validate($request, [
            'otp' => 'required|max:8',
            'mobile' => 'phone:US,BE,IN',
            'country_code' => 'required_with:mobile',
            'mac' => 'required',
        ]);

        $enterdOtp = $request->get('otp');
        $enterdMobile = $request->get('country_code') . $request->get('mobile');
        $userMacAddress = $request->get('mac');
        $ip = $request->ip();
        $fingureprint = $request->fingerprint();

        $otps = \App\Otp::where('mobile', $enterdMobile)->get();

        //check if user exists ? No - create one and generate api key

        try {
            $user = new User();
            foreach ($otps as $otp) {
                if ($otp != null && $enterdOtp == $otp->otp) {
                    if (30 > $otp->updated_at->diffInMinutes(Carbon::now())) {
                        $otp->v_status = 1;
                        $otp->created_at = $otp->created_at;
                        $otp->updated_at = Carbon::now();
                        if ($otp->save()) {
                            $user->mobile = $otp->mobile;
                            $user->v_status = 1;
                            $user->name = $request->get('name');
                            //$user->email = $request->get('email');
                            $user->password = \Hash::make($enterdOtp . $userMacAddress);
                            $user->ip_address = $request->ip();
                            $user->fingerprint = $request->fingerprint();
                            $user->verified_at = Carbon::now();
                            $user->created_at = Carbon::now();
                            $user->updated_at = Carbon::now();
                            if ($user->save()) {
                                //return $user;
                                return response()->json(['message' => 'success', 'status_code' => '1']);
                            } else {
                                return response()->json(['message' => 'error_adding_user', 'status_code' => '0']);
                                //echo $this->response->error('error_adding_user', 500);
                            }
                        } else
                            return response()->json(['message' => 'adding_user_otp', 'status_code' => '0']);
                            //echo $this->response->error('error_adding_user_otp', 500);
                    }else {
                        return response()->json(['message' => 'otp_expired', 'status_code' => '0']);
                        //return $this->response->error('error_otp_expired', 500);
                    }
                } else {
                    return response()->json(['message' => 'wrong_otp', 'status_code' => '0']);
                    //return $this->response->error('error_wrong_otp', 500);
                }
            }
        } catch (\PDOException $e) {

            //check if user exists ? Yes - Regenerate api key, it will lead in destroying users existing session
            //so only one installation at a time -- problem solved

            try {
                $usersArray = \App\User::where('mobile', $enterdMobile)->get();
                foreach ($usersArray as $userSingle) {
                    if ($userSingle != null && $enterdOtp == $otp->otp) {
                        if (30 > $otp->updated_at->diffInMinutes(Carbon::now())) {
                            $userSingle->password = \Hash::make($enterdOtp . $userMacAddress);
                            $userSingle->name = $request->get('name');
                            //$userSingle->email = $request->get('email');
                            $userSingle->ip_address = $request->ip();
                            $userSingle->fingerprint = $request->fingerprint();
                            $userSingle->created_at = $userSingle->created_at;
                            $userSingle->updated_at = Carbon::now();
                            if ($userSingle->save()) {
                                //return $userSingle;
                                return response()->json(['message' => 'success', 'status_code' => '1']);
                            } else {
                                return response()->json(['message' => 'error_updating_key', 'status_code' => '0']);
                                //echo $this->response->error('error_updating_key', 500);
                            }
                        } else {
                            return response()->json(['message' => 'otp_expired', 'status_code' => '0']);
                            //return $this->response->error('error_otp_expired', 500);
                        }
                    } else {
                        return response()->json(['message' => 'wrong_otp', 'status_code' => '0']);
                        //return $this->response->error('error_wrong_otp', 500);
                    }
                }
            } catch (\PDOException $e) {
                return $e;
            }
            return $e;
        }
    }

}
