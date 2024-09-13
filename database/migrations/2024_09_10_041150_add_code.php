<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('declaraciones', function (Blueprint $table) {
            $table->integer('payment_id')->unsigned();
            $table->string('code');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('declaraciones', function (Blueprint $table) {
            $table->dropColumn('payment_id');
            $table->dropColumn('code');
        });
    }
}
