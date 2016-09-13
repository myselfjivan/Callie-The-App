<?php

//namespace App\Http\Controllers;

namespace App\Api\V1\Controllers;

use JWTAuth;
use Validator;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;
use App\JwtToken;

class AuthenticateController extends Controller {

    use Helpers;

    public function authenticate(Request $request) {
        $credentials = $request->only(['mobile', 'password']);

        $validator = Validator::make($credentials, [
                    'mobile' => 'required',
                    'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->response->errorUnauthorized();
            }
        } catch (JWTException $e) {
            return $this->response->error('could_not_create_token', 500);
        }
        return response()->json(compact('token'));
    }

}
