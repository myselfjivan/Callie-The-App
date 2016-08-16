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

        $battery->status = $request->get('status');
        $battery->isCharging = $request->get('isCharging');
        $battery->chargePlug = $request->get('chargePlug');
        $battery->usbCharge = $request->get('usbCharge');
        $battery->acCharge = $request->get('acCharge');
        $battery->level = $request->get('level');
        $battery->scale = $request->get('scale');
        $battery->batteryPct = $request->get('batteryPct');

        if ($currentUser->battery()->save($battery))
            return $this->response->created();
        else
            return $this->response->error('could_not_update_battery_status', 500);
    }

}
