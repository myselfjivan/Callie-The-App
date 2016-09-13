<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCallLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('call_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile');
            $table->integer('BLOCKED_TYPE')->nullable(); //Call log type for calls blocked automatically.
            $table->string('CACHED_FORMATTED_NUMBER')->nullable(); //The cached phone number, formatted with formatting rules based on the country the user was in when the call was made or received.
            $table->string('CACHED_LOOKUP_URI')->nullable(); //The cached URI to look up the contact associated with the phone number, if it exists.
            $table->string('CACHED_MATCHED_NUMBER')->nullable(); //The cached phone number of the contact which matches this entry, if it exists.
            $table->string('CACHED_NAME')->nullable(); //The cached name associated with the phone number, if it exists.
            $table->string('CACHED_NORMALIZED_NUMBER')->nullable(); //The cached normalized(E164) version of the phone number, if it exists.
            $table->string('CACHED_NUMBER_LABEL')->nullable(); //The cached number label, for a custom number type, associated with the phone number, if it exists.
            $table->string('CACHED_NUMBER_TYPE')->nullable(); //The cached number type (Home, Work, etc) associated with the phone number, if it exists.
            $table->string('CACHED_PHOTO_ID')->nullable(); //The cached photo id of the picture associated with the phone number, if it exists.
            $table->string('CACHED_PHOTO_URI')->nullable(); //The cached photo URI of the picture associated with the phone number, if it exists.
            $table->string('CONTENT_ITEM_TYPE')->nullable(); // The MIME type of a CONTENT_URI sub-directory of a single call.
            $table->string('CONTENT_TYPE')->nullable(); //The MIMEtype of CONTENT_URI and CONTENT_FILTER_URI providing a directory of calls.
            $table->string('COUNTRY_ISO')->nullable(); //The ISO 3166-1 two letters country code of the country where the user received or made the call.
            $table->string('DATA_USAGE')->nullable(); //The data usage of the call in bytes.
            $table->string('DATE')->nullable(); //The date the call occured, in milliseconds since the epoch Type: INTEGER (long)
            $table->string('DEFAULT_SORT_ORDER')->nullable(); //The default sort order for this table
            $table->string('DURATION')->nullable(); //The duration of the call in seconds Type: INTEGER (long)
            $table->string('EXTRA_CALL_TYPE_FILTER')->nullable(); //An optional extra used with Calls.CONTENT_TYPE and ACTION_VIEW to specify that the presented list of calls should be filtered for a particular call type.
            $table->string('FEATURES')->nullable(); //Bit-mask describing features of the call (e.g.
            $table->integer('FEATURES_VIDEO')->nullable(); //Call had video.
            $table->string('GEOCODED_LOCATION')->nullable(); //A geocoded location for the number associated with this call.
            $table->integer('INCOMING_TYPE')->nullable(); //Call log type for incoming calls.
            $table->string('IS_READ')->nullable(); //Whether this item has been read or otherwise consumed by the user.
            $table->string('LAST_MODIFIED')->nullable(); //The date the row is last inserted, updated, or marked as deleted, in milliseconds since the epoch.
            $table->string('LIMIT_PARAM_KEY')->nullable(); //Query parameter used to limit the number of call logs returned.
            $table->integer('MISSED_TYPE')->nullable(); //Call log type for missed calls.
            $table->string('NEW')->nullable(); //Whether or not the call has been acknowledged Type: INTEGER (boolean)
            $table->string('NUMBER')->nullable(); //The phone number as the user entered it.
            $table->string('NUMBER_PRESENTATION')->nullable(); //The number presenting rules set by the network.
            $table->string('OFFSET_PARAM_KEY')->nullable(); //Query parameter used to specify the starting record to return.
            $table->integer('OUTGOING_TYPE')->nullable(); //Call log type for outgoing calls.
            $table->string('PHONE_ACCOUNT_COMPONENT_NAME')->nullable(); //The component name of the account used to place or receive the call; in string form.
            $table->string('PHONE_ACCOUNT_ID')->nullable(); //The identifier for the account used to place or receive the call.
            $table->string('POST_DIAL_DIGITS')->nullable(); //The post-dial portion of a dialed number, including any digits dialed after a DTMF_CHARACTER_PAUSE or a DTMF_CHARACTER_WAIT and these characters themselves.
            $table->integer('PRESENTATION_ALLOWED')->nullable(); //Number is allowed to display for caller id.
            $table->integer('PRESENTATION_PAYPHONE')->nullable(); //Number is a pay phone.
            $table->integer('PRESENTATION_RESTRICTED')->nullable(); //Number is blocked by user.
            $table->integer('PRESENTATION_UNKNOWN')->nullable(); //Number is not specified or unknown by network.
            $table->integer('REJECTED_TYPE')->nullable(); //Call log type for calls rejected by direct user action.
            $table->string('TRANSCRIPTION')->nullable(); //Transcription of the call or voicemail entry.
            $table->string('TYPE')->nullable(); //The type of the call (incoming, outgoing or missed).
            $table->string('VIA_NUMBER')->nullable(); //For an incoming call, the secondary line number the call was received via.
            $table->integer('VOICEMAIL_TYPE')->nullable(); //Call log type for voicemails.
            $table->string('VOICEMAIL_URI')->nullable(); //URI of the voicemail entry.
            $table->string('CONTENT_FILTER_URI')->nullable(); //The content:// style URL for filtering this table on phone numbers
            $table->string('CONTENT_URI')->nullable(); //The content:// style URL for this table
            $table->string('CONTENT_URI_WITH_VOICEMAIL')->nullable(); //Content uri used to access call log entries, including voicemail records.

            $table->integer('user_id')->index();
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        //
        Schema::drop("call_logs");
    }

}
