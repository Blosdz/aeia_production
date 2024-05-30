<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait MakeFile 
{
    public function makeFile($request,$filePath, $typeFile)
    {

      if (!file_exists(storage_path($filePath))) {
         Storage::makeDirectory('public/'.$filePath, 0777, true);
      }
      $input = $request->all();
      $file = $request->file($typeFile);
      $name = uniqid().'.'.$file->getClientOriginalExtension();
      $path = $filePath.$name;
      

      $input[$typeFile] = $path;

      $file->storeAs('public/'.$filePath, $name);
      return $input;
    }
    public function updateFile($request,$filePath,$value,$typeFile,$input)
    {
      if (!file_exists(storage_path($filePath))) {
         Storage::makeDirectory('public/'.$filePath, 0777, true);
      }

      $file = $request->file($typeFile);
      $name = uniqid().'.'.$file->getClientOriginalExtension();
      $path = $filePath.$name;
 
      if (is_file(storage_path('/app/public/'.$value[$typeFile])))
      {   
        unlink(storage_path('/app/public/'.$value[$typeFile]));
      }
      
      $input[$typeFile] = $path;
      $file->storeAs('public/'.$filePath, $name);
      return $input;
    }
    public function deleteFile($filePath,$value,$typeFile)
    {

      if (is_file(storage_path('/app/public/'.$value[$typeFile])))
      {   
        unlink(storage_path('/app/public/'.$value[$typeFile]));
      }
    }

    

}