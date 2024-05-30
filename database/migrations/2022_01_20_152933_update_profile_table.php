<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('dni_r')->nullable();
            $table->text('obs')->nullable();

            $table->string('dni2_r')->nullable();
            $table->text('obs2')->nullable();

            $table->string('dni3_r')->nullable();
            $table->text('obs3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('dni_r');
            $table->dropColumn('obs');
            $table->dropColumn('dni2_r');
            $table->dropColumn('obs2');
            $table->dropColumn('dni3_r');
            $table->dropColumn('obs3');
        });
    }
}
