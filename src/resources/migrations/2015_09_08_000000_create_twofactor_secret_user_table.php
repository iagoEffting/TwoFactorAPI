<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTwofactorSecretUserTable
 * Create a User table
 */
class CreateTwofactorSecretUserTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'secret_user',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('key')->index();
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
        Schema::drop('user_secrets');

    }


}
