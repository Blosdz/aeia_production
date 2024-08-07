<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMembresiasDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membresias_data', function (Blueprint $table) {
            $table->dropColumn('refered_code');
            $table->dropColumn('plan_id');
            $table->decimal('membership_collected', 30, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membresias_data', function (Blueprint $table) {
            $table->string('refered_code');
            $table->integer('membership_collected')->change();
        });
    }
}
