<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FondoHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('fondo_historials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fondo_id');
            $table->decimal('ganancia_neta', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->decimal('total_comisiones', 15, 2)->nullable();
            $table->timestamps();
            $table->foreign('fondo_id')->references('id')->on('total_amounts')->onUpdate('cascade')->onDelete('cascade');
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
	    Schema::dropIfExists('fondo_historials');
        //
    }
}
