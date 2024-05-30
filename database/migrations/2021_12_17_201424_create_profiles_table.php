<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('id');
            $table->string('dni')->nullable();
            $table->string('first_name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('country_document')->nullable();
            $table->string('type_document')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('nacionality')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->integer('verified')->default(0);

            $table->string('dni2')->nullable();
            $table->string('first_name2')->nullable();
            $table->string('lastname2')->nullable();
            $table->string('country_document2')->nullable();
            $table->string('type_document2')->nullable();
            $table->string('birthdate2')->nullable();
            $table->string('nacionality2')->nullable();
            $table->string('country2')->nullable();
            $table->string('city2')->nullable();
            $table->string('state2')->nullable();
            $table->string('address2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('job2')->nullable();
            $table->integer('verified2')->default(0);

            $table->string('dni3')->nullable();
            $table->string('first_name3')->nullable();
            $table->string('lastname3')->nullable();
            $table->string('country_document3')->nullable();
            $table->string('type_document3')->nullable();
            $table->string('birthdate3')->nullable();
            $table->string('nacionality3')->nullable();
            $table->string('country3')->nullable();
            $table->string('city3')->nullable();
            $table->string('state3')->nullable();
            $table->string('address3')->nullable();
            $table->string('phone3')->nullable();
            $table->string('job3')->nullable();
            $table->integer('verified3')->default(0);

            $table->foreignId('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
