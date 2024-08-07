<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MembresiasHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Historial_membresias',function(Blueprint $table){
            $table->id();
            $table->string('name');
		    $table->string('refered_code');
            $table->integer('plan_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('membership_collected',6,2)->default(0);
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
    }
}
