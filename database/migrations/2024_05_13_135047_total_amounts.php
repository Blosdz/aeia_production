<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TotalAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('total_amounts',function(Blueprint $table)
	    {
		    $table->id();
		    $table->integer('month')->nullable();
		    $table->decimal('total',30,2)->nullable();
		    $table->decimal('ganancia_de_capital',30,2)->nullable();
		    $table->decimal('total_impuesto',30,2)->nullable();
		    $table->decimal('total_comisiones',30,2)->nullable();
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
	    Schema::dropIfExists('total_amounts');
	    
    }
}
