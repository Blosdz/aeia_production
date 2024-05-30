<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FondoHistoriaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('fondo_historia_clientes', function (Blueprint $table) {
            $table->id();
	    $table->unsignedBigInteger('fondo_cliente_id')->nullable();
	    $table->integer('month')->nullable();
            $table->decimal('total_invertido', 30, 2)->nullable();
            $table->decimal('ganancia', 30, 2)->nullable();
            $table->decimal('rentabilidad', 30, 2)->nullable();
            $table->timestamps();
	    $table->foreign('fondo_cliente_id')->references('id')->on('fondo_clientes')->onUpdate('cascade')->onDelete('cascade');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

	Schema::dropIfExists('fondo_historia_clientes');
        //
    }
}
