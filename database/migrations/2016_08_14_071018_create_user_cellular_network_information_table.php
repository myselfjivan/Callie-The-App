<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCellularNetworkInformationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('cellular_network_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('ACTION_CONFIGURE_VOICEMAIL')->nullable();
            // String ACTION_CONFIGURE_VOICEMAIL; Open the voicemail settings activity to make changes to voicemail configuration.
            $table->string('ACTION_PHONE_STATE_CHANGED')->nullable();
            // String ACTION_PHONE_STATE_CHANGED; Broadcast intent action indicating that the call state on the device has changed.
            $table->string('ACTION_RESPOND_VIA_MESSAGE')->nullable();
            // String ACTION_RESPOND_VIA_MESSAGE; The Phone app sends this intent when a user opts to respond-via-message during an incoming call.
            $table->integer('CALL_STATE_IDLE')->nullable();
            //int CALL_STATE_IDLE; Device call state: No Activity.
            $table->integer('CALL_STATE_OFFHOOK')->nullable();
            // int CALL_STATE_OFFHOOK; Device call state: Off-hook.
            $table->integer('CALL_STATE_RINGING')->nullable();
            //int CALL_STATE_RINGING; Device call state: Ringing.
            $table->integer('DATA_ACTIVITY_DORMANT')->nullable();
            //int DATA_ACTIVITY_DORMANT; Data connection is active, but physical link is down.
            $table->integer('DATA_ACTIVITY_IN')->nullable();
            //int DATA_ACTIVITY_IN; Data connection activity: Currently receiving IP PPP traffic.
            $table->integer('DATA_ACTIVITY_INOUT')->nullable();
            //int DATA_ACTIVITY_INOUT; Data connection activity: Currently both sending and receiving IP PPP traffic.
            $table->integer('DATA_ACTIVITY_NONE')->nullable();
            //int DATA_ACTIVITY_NONE; Data connection activity: No traffic.
            $table->integer('DATA_ACTIVITY_OUT')->nullable();
            //int DATA_ACTIVITY_OUT; Data connection activity: Currently sending IP PPP traffic.
            $table->integer('DATA_CONNECTED')->nullable();
            //int DATA_CONNECTED; Data connection state: Connected.
            $table->integer('DATA_CONNECTING')->nullable();
            //int DATA_CONNECTING; Data connection state: Currently setting up a data connection.
            $table->integer('DATA_DISCONNECTED')->nullable();
            //int DATA_DISCONNECTED; Data connection state: Disconnected.
            $table->integer('DATA_SUSPENDED')->nullable();
            //int DATA_SUSPENDED; Data connection state: Suspended.
            $table->string('EXTRA_INCOMING_NUMBER')->nullable();
            //String EXTRA_INCOMING_NUMBER; The lookup key used with the ACTION_PHONE_STATE_CHANGED broadcast for a String containing the incoming phone number.
            $table->string('EXTRA_STATE')->nullable();
            //String EXTRA_STATE; The lookup key used with the ACTION_PHONE_STATE_CHANGED broadcast for a String containing the new call state.
            $table->integer('NETWORK_TYPE_1xRTT')->nullable();
            //int NETWORK_TYPE_1xRTT; Current network is 1xRTT.
            $table->integer('NETWORK_TYPE_CDMA')->nullable();
            //int NETWORK_TYPE_CDMA; Current network is CDMA: Either IS95A or IS95B.
            $table->integer('NETWORK_TYPE_EDGE')->nullable();
            //int NETWORK_TYPE_EDGE; Current network is EDGE.
            $table->integer('NETWORK_TYPE_EHRPD')->nullable();
            //int NETWORK_TYPE_EHRPD; Current network is eHRPD.
            $table->integer('NETWORK_TYPE_EVDO_0')->nullable();
            //int NETWORK_TYPE_EVDO_0; Current network is EVDO revision 0.
            $table->integer('NETWORK_TYPE_EVDO_A')->nullable();
            //int NETWORK_TYPE_EVDO_A; Current network is EVDO revision A.
            $table->integer('NETWORK_TYPE_EVDO_B')->nullable();
            //int NETWORK_TYPE_EVDO_B; Current network is EVDO revision B
            $table->integer('NETWORK_TYPE_GPRS')->nullable();
            //int NETWORK_TYPE_GPRS; Current network is GPRS
            $table->integer('NETWORK_TYPE_HSDPA')->nullable();
            //int NETWORK_TYPE_HSDPA; Current network is HSDPA
            $table->integer('NETWORK_TYPE_HSPA')->nullable();
            //int NETWORK_TYPE_HSPA; Current network is HSPA
            $table->integer('NETWORK_TYPE_HSPAP')->nullable();
            //int NETWORK_TYPE_HSPAP; Current network is HSPA+
            $table->integer('NETWORK_TYPE_HSUPA')->nullable();
            //int NETWORK_TYPE_HSUPA; Current network is HSUPA
            $table->integer('NETWORK_TYPE_IDEN')->nullable();
            //int NETWORK_TYPE_IDEN; Current network is iDen
            $table->integer('NETWORK_TYPE_LTE')->nullable();
            //int NETWORK_TYPE_LTE; Current network is LTE
            $table->integer('NETWORK_TYPE_UMTS')->nullable();
            //int NETWORK_TYPE_UMTS; Current network is UMTS
            $table->integer('NETWORK_TYPE_UNKNOWN')->nullable();
            //int NETWORK_TYPE_UNKNOWN; Network type is unknown
            $table->integer('PHONE_TYPE_CDMA')->nullable();
            //int PHONE_TYPE_CDMA; Phone radio is CDMA.
            $table->integer('PHONE_TYPE_GSM')->nullable();
            //int PHONE_TYPE_GSM; Phone radio is GSM.
            $table->integer('PHONE_TYPE_NONE')->nullable();
            //int PHONE_TYPE_NONE; No phone radio.
            $table->integer('PHONE_TYPE_SIP')->nullable();
            //int PHONE_TYPE_SIP; Phone is via SIP.
            $table->integer('SIM_STATE_ABSENT')->nullable();
            //int SIM_STATE_ABSENT; SIM card state: no SIM card is available in the device
            $table->integer('SIM_STATE_NETWORK_LOCKED')->nullable();
            //int SIM_STATE_NETWORK_LOCKED; SIM card state: Locked: requires a network PIN to unlock
            $table->integer('SIM_STATE_PIN_REQUIRED')->nullable();
            //int SIM_STATE_PIN_REQUIRED; SIM card state: Locked: requires the user's SIM PIN to unlock
            $table->integer('SIM_STATE_PUK_REQUIRED')->nullable();
            //int SIM_STATE_PUK_REQUIRED; SIM card state: Locked: requires the user's SIM PUK to unlock
            $table->integer('SIM_STATE_READY')->nullable();
            //int SIM_STATE_READY; SIM card state: Ready
            $table->integer('SIM_STATE_UNKNOWN')->nullable();
            //int SIM_STATE_UNKNOWN; SIM card state: Unknown.
            $table->integer('VVM_TYPE_CVVM')->nullable();
            //int VVM_TYPE_CVVM; A flavor of OMTP protocol with a different mobile originated (MO) format
            $table->integer('VVM_TYPE_OMTP')->nullable();
            //int VVM_TYPE_OMTP; The OMTP protocol .

            $table->integer('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop("cellular_network_information");
    }

}
