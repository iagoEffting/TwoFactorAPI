<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetwofactorAccessUserTable extends Migration
{


      /**
       * Run the migrations.
       *
       * @return void
       */
    public function up()
    {
        Schema::create(
            'access_user',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('ip');
                $table->string('browser');
                $table->integer('user_id');
                $table->timestamps();
            }
        );

    }


      /**
       * Reverse the migrations.
       *
       * @return void
       */
    public function down()
    {
        Schema::drop('access_user');

    }


}
