<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\UserBattery;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class UserBatteryInformationController extends Controller {

    use Helpers;

    public function store(Request $request) {

//        $this->validate($request, [
//            'status' => 'required|min:1',
//        ]);

        $currentUser = JWTAuth::parseToken()->authenticate();

        $battery = new UserBattery;

        try {
            $requestAll = $request->all();
            if (count($requestAll) <= 1) {
                return response()->json(['message' => 'too_less_parameters', 'status_code' => '0']);
            } else {

                $battery->status = $request->get('status');
                $battery->isCharging = $request->get('isCharging');
                $battery->chargePlug = $request->get('chargePlug');
                $battery->usbCharge = $request->get('usbCharge');
                $battery->acCharge = $request->get('acCharge');
                $battery->level = $request->get('level');
                $battery->scale = $request->get('scale');
                $battery->batteryPct = $request->get('batteryPct');
                if ($currentUser->callLogs()->save($battery))
                    return response()->json(['message' => 'updated_battery_status', 'status_code' => '1']);
                //return $this->response->created();
                else
                    return response()->json(['message' => 'could_not_update_battery_status', 'status_code' => '0']);
                //return $this->response->error('could_not_update_battery_status', 500);
            }
        } catch (PDOException $e) {
            return response()->json(['message' => 'error_updating_battery_information', 'status_code' => '0']);
        }
    }

}
