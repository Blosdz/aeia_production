<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JsonTotals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('total_amounts', function (Blueprint $table) {
            $table->json('amounts_historial')->nullable();
        });
        Schema::table('fondo_clientes', function (Blueprint $table) {
            $table->json('fondo_historial')->nullable();
        });
        Schema::table('profiles',function(Blueprint $table){
            $table->string('KYC')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('total_amounts', function (Blueprint $table) {
            $table->dropColumn('amounts_historial')->nullable();
        });
        Schema::table('fondo_clientes', function (Blueprint $table) {
            $table->dropColumn('fondo_historial')->nullable();
        });
        Schema::table('profiles',function(Blueprint $table){
            $table->dropColumn('KYC')->nullable();
        });
    }
}