<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeclaracionVoluntaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('declaraciones',function(Blueprint $table){
            $table->id('id');
            $table->integer('user_id')->unsigned();
            $table->integer('type');
            $table->string('full_name');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->string('country_document');
            $table->string('type_document');
            $table->string('identification_number');
            $table->string('signature_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('declaraciones');
    }
}
