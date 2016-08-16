<?php

//namespace App\Http\Controllers;

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Status;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class StatusController extends Controller {

    use Helpers;

    //
    public function index() {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
                        ->status()
                        ->orderBy('created_at', 'DESC', 'LIMIT 1')
                        ->limit('1')
                        ->get()
                        ->toArray();
    }

    public function last10() {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
                        ->status()
                        ->orderBy('created_at', 'DESC', 'LIMIT 1')
                        ->limit('10')
                        ->get()
                        ->toArray();
    }

    public function store(Request $request) {

        $this->validate($request, [
            'status' => 'required|min:1',
        ]);
        $currentUser = JWTAuth::parseToken()->authenticate();

        $status = new Status;

        $status->status = $request->get('status');

        if ($currentUser->status()->save($status))
            return response()->json(['message' => 'created_status', 'status_code' => '1']);
            //return $this->response->created();
        else
            return response()->json(['message' => 'could_not_create_status', 'status_code' => '0']);
            //return $this->response->error('could_not_create_status', 500);
    }

    public function showOtherUserStatus($mobile) {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $users = \App\User::where('mobile', $mobile)->get();
        if(count($users)==null){ return response()->json(['status' => 'user_does_not_exists', 'status_code' => '0']);}
        foreach ($users as $user)
            $statuses = \App\Status::where('user_id', $user->id)->get();
        foreach ($statuses as $status)
            $last = $statuses->last();
        //$arr[] = array('status' => "$last->status", 'updated_at' => "$last->updated_at");
        //return json_encode($arr);
        return response()->json(['status' => $last->status, 'updated_at' => $last->updated_at]);
    }

}
