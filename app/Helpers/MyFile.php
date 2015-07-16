<?php namespace App\Helpers;

class MyFile {

    public static function randomAvatar(){

        $num = rand(1 , 10 );

        $route["avatar_thumbnail"] = asset('assets/images/av'.$num.'_thumb.jpg');
        $route['avatar_standar'] = asset('assets/images/av'.$num.'.jpg');

        return $route;

    }
}


