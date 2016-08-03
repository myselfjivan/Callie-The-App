<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phonetic_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('date')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('notes')->nullable();
            $table->string('im')->nullable();
            $table->string('sip')->nullable();
            $table->string('group_name')->nullable();
            $table->string('website')->nullable();
            $table->string('relationship')->nullable();
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
        Schema::drop('contacts');
    }

}
