<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBatteryStatusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('battery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable();
            $table->boolean('isCharging')->nullable();
            $table->integer('chargePlug')->nullable();
            $table->boolean('usbCharge')->nullable();
            $table->boolean('acCharge')->nullable();
            $table->integer('level')->nullable();
            $table->integer('scale')->nullable();
            $table->float('batteryPct')->nullable();
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
        Schema::drop("battery");
    }

}
