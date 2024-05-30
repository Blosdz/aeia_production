<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// using str random 
use Illuminate\Support\Str;
// importing the user table

use App\Models\User;

class AddCodeUniqueUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('unique_code')->unique()->nullable();

        });
        //
        $users=User::all();
        foreach ($users as $user)
        {
            $user->unique_code=Str::random(5);
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('unique_code');
        });
    }
}

