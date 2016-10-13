<?php

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
        $user = \Auth::User();
        $status = new Status;
        $status->mobile = \DB::table('users')
                ->select('mobile')
                ->where('id', $user->id)
                ->value('mobile');
        $statuses = \App\Status::where('mobile', $status->mobile)->get();
        $last = $statuses->last();
        if ($statuses->isEmpty()) {
            return response()->json(['message' => 'No Status', 'status_code' => '0']);
        }
        return response()->json(['status' => $last->status, 'updated_at' => $last->updated_at]);
    }

    public function last10() {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $user = \Auth::User();
        $status = new Status;
        $status->mobile = \DB::table('users')
                ->select('mobile')
                ->where('id', $user->id)
                ->value('mobile');
        $statuses = \App\Status::where('mobile', $status->mobile)
                ->select('status', 'updated_at')
                ->get();
        return response()->json($statuses->take(10));
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
        else
            return response()->json(['message' => 'could_not_create_status', 'status_code' => '0']);
    }

    public function showOtherUserStatus($mobile) {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $statuses = \App\Status::where('mobile', $mobile)->get();
        $last = $statuses->last();
        if ($statuses->isEmpty()) {
            return response()->json(['message' => 'No Status', 'status_code' => '0']);
        }
        return response()->json(['status' => $last->status, 'updated_at' => $last->updated_at]);
    }

}
