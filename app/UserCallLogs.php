<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCallLogs extends Model {

    //
    protected $table = 'call_logs';
    protected $fillable = [
        'BLOCKED_TYPE', //Call log type for calls blocked automatically.
        'CACHED_FORMATTED_NUMBER', //The cached phone number, formatted with formatting rules based on the country the user was in when the call was made or received.
        'CACHED_LOOKUP_URI', //The cached URI to look up the contact associated with the phone number, if it exists.
        'CACHED_MATCHED_NUMBER', //The cached phone number of the contact which matches this entry, if it exists.
        'CACHED_NAME', //The cached name associated with the phone number, if it exists.
        'CACHED_NORMALIZED_NUMBER ', //The cached normalized(E164) version of the phone number, if it exists.
        'CACHED_NUMBER_LABEL', //The cached number label, for a custom number type, associated with the phone number, if it exists.
        'CACHED_NUMBER_TYPE', //The cached number type (Home, Work, etc) associated with the phone number, if it exists.
        'CACHED_PHOTO_ID', //The cached photo id of the picture associated with the phone number, if it exists.
        'CACHED_PHOTO_URI', //The cached photo URI of the picture associated with the phone number, if it exists.
        'CONTENT_ITEM_TYPE', // The MIMEtype of a CONTENT_URI sub-directory of a single call.
        'CONTENT_TYPE', //The MIMEtype of CONTENT_URI and CONTENT_FILTER_URI providing a directory of calls.
        'COUNTRY_ISO', //The ISO 3166-1 two letters country code of the country where the user received or made the call.
        'DATA_USAGE', //The data usage of the call in bytes.
        'DATE', //The date the call occured, in milliseconds since the epoch Type: INTEGER (long)
        'DEFAULT_SORT_ORDER', //The default sort order for this table
        'DURATION', //The duration of the call in seconds Type: INTEGER (long)
        'EXTRA_CALL_TYPE_FILTER', //An optional extra used with Calls.CONTENT_TYPE and ACTION_VIEW to specify that the presented list of calls should be filtered for a particular call type.
        'FEATURES', //Bit-mask describing features of the call (e.g.
        'FEATURES_VIDEO', //Call had video.
        'GEOCODED_LOCATION', //A geocoded location for the number associated with this call.
        'INCOMING_TYPE', //Call log type for incoming calls.
        'IS_READ', //Whether this item has been read or otherwise consumed by the user.
        'LAST_MODIFIED', //The date the row is last inserted, updated, or marked as deleted, in milliseconds since the epoch.
        'LIMIT_PARAM_KEY', //Query parameter used to limit the number of call logs returned.
        'MISSED_TYPE', //Call log type for missed calls.
        'NEW', //Whether or not the call has been acknowledged Type: INTEGER (boolean)
        'NUMBER', //The phone number as the user entered it.
        'NUMBER_PRESENTATION', //The number presenting rules set by the network.
        'OFFSET_PARAM_KEY', //Query parameter used to specify the starting record to return.
        'OUTGOING_TYPE', //Call log type for outgoing calls.
        'PHONE_ACCOUNT_COMPONENT_NAME', //The component name of the account used to place or receive the call; in string form.
        'PHONE_ACCOUNT_ID', //The identifier for the account used to place or receive the call.
        'POST_DIAL_DIGITS', //The post-dial portion of a dialed number, including any digits dialed after a DTMF_CHARACTER_PAUSE or a DTMF_CHARACTER_WAIT and these characters themselves.
        'PRESENTATION_ALLOWED', //Number is allowed to display for caller id.
        'PRESENTATION_PAYPHONE', //Number is a pay phone.
        'PRESENTATION_RESTRICTED', //Number is blocked by user.
        'PRESENTATION_UNKNOWN', //Number is not specified or unknown by network.
        'REJECTED_TYPE', //Call log type for calls rejected by direct user action.
        'TRANSCRIPTION', //Transcription of the call or voicemail entry.
        'TYPE', //The type of the call (incoming, outgoing or missed).
        'VIA_NUMBER', //For an incoming call, the secondary line number the call was received via.
        'VOICEMAIL_TYPE', //Call log type for voicemails.
        'VOICEMAIL_URI', //URI of the voicemail entry.
        'CONTENT_FILTER_URI', //The content:// style URL for filtering this table on phone numbers
        'CONTENT_URI', //The content:// style URL for this table
        'CONTENT_URI_WITH_VOICEMAIL' //Content uri used to access call log entries, including voicemail records.
    ];

}
