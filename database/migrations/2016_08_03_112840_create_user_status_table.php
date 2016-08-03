<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('status', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // adding specific fields here...
            $table->string('status');
            //$table->string('author_name');
            //$table->integer('pages_count');
            $table->integer('user_id')->index();

            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop("status");
    }

}