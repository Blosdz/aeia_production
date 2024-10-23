<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToUsersTable extends Migration
{
    //no need since soft_deletes manage this part 
    // public function up()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->softDeletes(); // Esto agrega la columna deleted_at
    //     });
    // }

    // public function down()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->dropSoftDeletes(); // Esto eliminará la columna deleted_at
    //     });
    // }
}
