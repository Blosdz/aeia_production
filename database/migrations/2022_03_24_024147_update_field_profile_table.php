<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('sex')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('address_wallet')->nullable();
            $table->integer('identification_number')->nullable();

            $table->string('sex2')->nullable();
            $table->string('profile_picture2')->nullable();
            $table->string('address_wallet2')->nullable();
            $table->integer('identification_number2')->nullable();

            $table->string('sex3')->nullable();
            $table->string('profile_picture3')->nullable();
            $table->string('address_wallet3')->nullable();
            $table->integer('identification_number3')->nullable();
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
            $table->dropColumn('sex');
            $table->dropColumn('profile_picture');
            $table->dropColumn('address_wallet');

            $table->dropColumn('sex2');
            $table->dropColumn('profile_picture2');
            $table->dropColumn('address_wallet2');

            $table->dropColumn('sex3');
            $table->dropColumn('profile_picture3');
            $table->dropColumn('address_wallet3');
        });
        
    }
}
