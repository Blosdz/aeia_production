<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextAreaAndImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('payments',function (Blueprint $table){
            $table->string('voucher_picture')->nullable();
            $table->string('comments_on_payment')->nullable();
            $table->string('user_name')->nullable();
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
        Schema::table('payments',function(Blueprint $table){
            $table->dropColumn('voucher_picture');
            $table->dropColumn('comments_on_payment');
            $table->dropColumn('user_name');
        });
    }
}

