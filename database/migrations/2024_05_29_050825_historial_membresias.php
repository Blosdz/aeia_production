<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistorialMembresias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('membresias_data',function(Blueprint $table){
		$table->id('id');
		$table->string('name');
		$table->string('refered_code');
		$table->integer('plan_id');
		$table->integer('membership_collected');
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
	Schema::drop('membresias_data');
    }
}
