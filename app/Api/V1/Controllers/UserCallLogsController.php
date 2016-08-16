<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\UserCallLogs;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class UserCallLogsController extends Controller {

    //
    use Helpers;

    public function store(Request $request) {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $callLog = new UserCallLogs;
        try {
            $requestAll = $request->all();
            if (count($requestAll) <= 1) {
                return response()->json(['message' => 'too_less_parameters', 'status_code' => '0']);
            } else {
                $callLog->BLOCKED_TYPE = $request->get('BLOCKED_TYPE');
                $callLog->CACHED_FORMATTED_NUMBER = $request->get('CACHED_FORMATTED_NUMBER');
                $callLog->CACHED_LOOKUP_URI = $request->get('CACHED_LOOKUP_URI');
                $callLog->CACHED_NAME = $request->get('CACHED_NAME');
                $callLog->CACHED_NORMALIZED_NUMBER = $request->get('CACHED_NORMALIZED_NUMBER');
                $callLog->CACHED_NUMBER_LABEL = $request->get('CACHED_NUMBER_LABEL');
                $callLog->CACHED_NUMBER_TYPE = $request->get('CACHED_NUMBER_TYPE');
                $callLog->CACHED_PHOTO_ID = $request->get('CACHED_PHOTO_ID');
                $callLog->CACHED_PHOTO_URI = $request->get('CACHED_PHOTO_URI');
                $callLog->CONTENT_ITEM_TYPE = $request->get('CONTENT_ITEM_TYPE');
                $callLog->CONTENT_TYPE = $request->get('CONTENT_TYPE');
                $callLog->COUNTRY_ISO = $request->get('COUNTRY_ISO');
                $callLog->DATA_USAGE = $request->get('DATA_USAGE');
                $callLog->DATE = $request->get('DATE');
                $callLog->DEFAULT_SORT_ORDER = $request->get('DEFAULT_SORT_ORDER');
                $callLog->DURATION = $request->get('DURATION');
                $callLog->EXTRA_CALL_TYPE_FILTER = $request->get('EXTRA_CALL_TYPE_FILTER');
                $callLog->FEATURES = $request->get('FEATURES');
                $callLog->FEATURES_VIDEO = $request->get('FEATURES_VIDEO');
                $callLog->GEOCODED_LOCATION = $request->get('GEOCODED_LOCATION');
                $callLog->INCOMING_TYPE = $request->get('INCOMING_TYPE');
                $callLog->IS_READ = $request->get('IS_READ');
                $callLog->LAST_MODIFIED = $request->get('LAST_MODIFIED');
                $callLog->LIMIT_PARAM_KEY = $request->get('LIMIT_PARAM_KEY');
                $callLog->MISSED_TYPE = $request->get('MISSED_TYPE');
                $callLog->NEW = $request->get('NEW');
                $callLog->NUMBER = $request->get('NUMBER');
                $callLog->NUMBER_PRESENTATION = $request->get('NUMBER_PRESENTATION');
                $callLog->OFFSET_PARAM_KEY = $request->get('OFFSET_PARAM_KEY');
                $callLog->OUTGOING_TYPE = $request->get('OUTGOING_TYPE');
                $callLog->PHONE_ACCOUNT_COMPONENT_NAME = $request->get('PHONE_ACCOUNT_COMPONENT_NAME');
                $callLog->PHONE_ACCOUNT_ID = $request->get('PHONE_ACCOUNT_ID');
                $callLog->POST_DIAL_DIGITS = $request->get('POST_DIAL_DIGITS');
                $callLog->PRESENTATION_ALLOWED = $request->get('PRESENTATION_ALLOWED');
                $callLog->PRESENTATION_PAYPHONE = $request->get('PRESENTATION_PAYPHONE');
                $callLog->PRESENTATION_RESTRICTED = $request->get('PRESENTATION_RESTRICTED');
                $callLog->PRESENTATION_UNKNOWN = $request->get('PRESENTATION_UNKNOWN');
                $callLog->REJECTED_TYPE = $request->get('REJECTED_TYPE');
                $callLog->TRANSCRIPTION = $request->get('TRANSCRIPTION');
                $callLog->TYPE = $request->get('TYPE');
                $callLog->VIA_NUMBER = $request->get('VIA_NUMBER');
                $callLog->VOICEMAIL_TYPE = $request->get('VOICEMAIL_TYPE');
                $callLog->VOICEMAIL_URI = $request->get('VOICEMAIL_URI');
                $callLog->CONTENT_FILTER_URI = $request->get('CONTENT_FILTER_URI');
                $callLog->CONTENT_URI = $request->get('CONTENT_URI');
                $callLog->CONTENT_URI_WITH_VOICEMAIL = $request->get('CONTENT_URI_WITH_VOICEMAIL');
                if ($currentUser->callLogs()->save($callLog))
                    return response()->json(['message' => 'updated_call_logs', 'status_code' => '1']);
                //return $this->response->created();
                else
                    return response()->json(['message' => 'could_not_update_call_logs', 'status_code' => '0']);
                //return $this->response->error('could_not_update_battery_status', 500);
            }
        } catch (PDOException $e) {
            
        }
    }

}
