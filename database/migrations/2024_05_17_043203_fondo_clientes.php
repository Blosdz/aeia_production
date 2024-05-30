<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FondoClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('fondo_clientes',function(Blueprint $table){
		    $table->id();
		    $table->integer('month')->nullable();
		    $table->string('plan_id_fondo')->nullable();
		    $table->string('planId')->nullable();
		    $table->decimal('monto_invertido',30,2)->default(0);
		    $table->decimal('ganancia',30,2)->default(0);
		    $table->decimal('Balance',30,2)->default(0);
		    $table->decimal('rentabilidad',30,2)->default(0);
		    $table->foreignId('user_id')->unsigned()->nullable();
		    $table->foreign('user_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('cascade');
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
	Schema::dropIfExists('fondo_clientes');
    }
}
