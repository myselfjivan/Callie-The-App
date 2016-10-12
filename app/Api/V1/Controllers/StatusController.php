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
        $user = \Auth::User();
        $status = new Status;
        $status->mobile = \DB::table('users')
                ->select('mobile')
                ->where('id', $user->id)
                ->value('mobile');
        $statuses = \App\Status::where('mobile', $status->mobile)->get();
        //$statuses = $currentUser->status;
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
        $statuses = \App\Status::where('mobile', $status->mobile)->get();
        $status = $statuses->take(10);
        $plucked =  $status->pluck('status');
        return $plucked;
        //foreach($status as $abcd){
            //echo json_encode(['status' => $status->pluck('status')]);
        //}
        //$plucked = $statuseses->pluck('status');
        //return response()->json(['satatus' => $statuses->pluck('status'), 'updated_at' => $statuses->pluck('updated_at')]);
        //return response()->json([$status]);
//        foreach ($status as $status1) {
//            //echo $status['status'];
//            //echo json(['status' => $status->status]);
//            echo json_encode(['status' => $status1('status')]);
//        }
        //return response()->json(['status' => $statuses->status]);
//      return $currentUser
//                        ->status()
//                        ->orderBy('created_at', 'DESC', 'LIMIT 1')
//                        ->limit('10')
//                        ->get()
//                        ->toArray();
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
        if($statuses->isEmpty()){
            return response()->json(['message' => 'No Status', 'status_code' => '0']);
        }
        return response()->json(['status' => $last->status, 'updated_at' => $last->updated_at]);
    }

}
