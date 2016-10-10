<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id');
            $table->string('username');
            $table->string('name')->nullable();
            $table->string('mobile')->unique();
            $table->string('v_status');
            $table->string('password');
            $table->string('ip_address');
            $table->string('fingerprint');
            $table->timestamp('verified_at');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
