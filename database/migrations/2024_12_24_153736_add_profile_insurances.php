<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('profiles',function(Blueprint $table){
            $table->integer('total_insured')->unsigned()->nullable();
            $table->json('data_filled_insured')->nullable();
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
        Schema::table('profiles',function(Blueprint $table){
            $table->dropColumn('total_insured');
            $table->dropColumn('data_filled_insured');
        });
    }
}
