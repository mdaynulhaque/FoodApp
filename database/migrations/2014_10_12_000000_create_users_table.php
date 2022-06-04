<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('res_name');
            $table->string('phone_no');
            $table->string('email');
            $table->string('website_url');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('street_address');
            $table->unsignedInteger('thana_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedTinyInteger('status')->default(0);

            $table->string('avatar')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
