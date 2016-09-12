<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJwtAccessTokenTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('jwt_access_token', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('mobile');
            $table->string('token');
            $table->timestamps();
        }
        );
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {
        Schema::drop('otp');
        //
    }

}
