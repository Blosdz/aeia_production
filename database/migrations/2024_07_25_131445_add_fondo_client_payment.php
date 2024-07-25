<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFondoClientPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('client_payments',function(Blueprint $table){
            $table->string('fondo_name')->nullable();
        });
        Schema::table('total_amounts',function(Blueprint $table){
            $table->string('fondo_name')->nullable();
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
        Schema::table('client_payments',function(Blueprint $table){
            $table->dropColumn('fondo_name');
        });
        Schema::table('total_amounts',function(Blueprint $table){
            $table->dropColumn('fondo_name');
        });


    }
}
