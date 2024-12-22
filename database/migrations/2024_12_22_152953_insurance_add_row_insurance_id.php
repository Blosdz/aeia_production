<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsuranceAddRowInsuranceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('clientInsurance',function(Blueprint $table){
            $table->foreignId('insurance_id')->unsigned()->nullable();
            $table->foreign('insurance_id')->references('id')->on('insurance')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('clientInsurance',function(Blueprint $table){
            $table->dropColumn('insurance_id');
        });
    }
}
