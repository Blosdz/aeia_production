<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Facturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('facturas_admin',function(Blueprint $table){
		    $table->id();
		    $table->string('route_path');
		    $table->string('user_name');
		    $table->unsignedBigInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
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
        //
	    Schema::dropIfExists('facturas_admin');
    }
}
