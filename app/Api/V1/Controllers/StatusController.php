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
        $user = \Auth::User();
        $status = new Status;
        $status->status = $request->get('status');
        $status->mobile = \DB::table('users')
                ->select('mobile')
                ->where('id', $user->id)
                ->value('mobile');

        if ($currentUser->status()->save($status))
            return response()->json(['message' => 'created_status', 'status_code' => '1']);
        //return $this->response->created();
        else
            return response()->json(['message' => 'could_not_create_status', 'status_code' => '0']);
        //return $this->response->error('could_not_create_status', 500);
    }

    public function showOtherUserStatus($mobile) {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $statuses = \App\Status::where('mobile', $mobile)->get();
        foreach ($statuses as $status)
            $last = $statuses->last();
        return response()->json(['status' => $last->status, 'updated_at' => $last->updated_at]);
    }

}
