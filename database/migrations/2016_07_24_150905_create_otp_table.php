<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtpTable extends Migration
{
    
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        //
        Schema::create('otp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->index()->unique();
            $table->string('otp');
            $table->string('status');
            $table->timestamp('created_at');
        }
        );
    }
    
    /*
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('otp');
        //
    }
}