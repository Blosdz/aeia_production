<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBinanceFieldsToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('prepay_code')->nullable();
            $table->timestamp('expire_time')->nullable();
            $table->string('transact_code')->nullable();
            $table->timestamp('transact_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('prepay_code');
            $table->dropColumn('expire_time');
            $table->dropColumn('transact_code');
            $table->dropColumn('transact_timestamp');
        });
    }
}
