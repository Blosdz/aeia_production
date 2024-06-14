<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFondoGeneralAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('total_amounts',function(Blueprint $table){
            $table->decimal('fondo_general',30,2)->nullable();
        });
        Schema::table('fondo_historials',function(Blueprint $table){
            $table->decimal('fondo_general',30,2)->nullable();
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
        Schema::table('total_amounts',function(Blueprint $table){
            $table->dropColumn('fondo_general');
        });        
        Schema::table('fondo_historials',function(Blueprint $table){
            $table->dropColumn('fondo_general');
        });
    }
}
