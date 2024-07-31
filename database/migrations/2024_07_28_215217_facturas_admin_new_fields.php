<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacturasAdminNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('facturas_admin',function(Blueprint $table){
            $table->string('fondo_name')->default('default_fondo_name')->notNull();
            $table->integer('plan_id')->default(0)->notNull();
            $table->double('total')->default(0)->notNull();
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
        Schema::table('facturas_admin',function(Blueprint $table){
            $table->dropColumn('fondo_name');
            $table->dropColumn('plan_id');
            $table->dropColumn('total');

        });
    }
}
