<?php

namespace App\Traits;

use App\Models\Bells;

trait BellTrait {


    public static function verifyNotification( $user_id, $row, $value){

        $bell = Bells::where('user_id', $user_id)->first();        

        if( empty($bell) ){
          return self::createSetVariable($user_id, $row, $value);
        }

        return self::updateVariable($bell, $row, $value);
    }

    private static function createSetVariable($user_id, $row, $value){

      $bell = Bells::create([
        'user_id' => $user_id,
        $row => $value,
      ]);

      return $bell;
    }

    private static function updateVariable($model, $row, $value){

      $input = [ $row => $value ];

      $model->fill($input);
      $model->save();

      return $model;

    }

}
