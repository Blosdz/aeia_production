<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $result = file_get_contents(public_path() . "/countries.js");
        preg_match('#\[(.*?)\]#', preg_replace('/\s+/', '',preg_replace('/(?:\h*<!--|(?<!\A|-->\n)\G).*\R/','',str_replace("*/", "-->", str_replace("/*", "<!--", $result)))), $match);
        $result = json_decode($match[0]); 
        $filledArray;
        foreach($result as $key => $value) {
            $filledArray[$value->name] = $value->name;
        }
        View::share('countries', $filledArray);

    }
}
