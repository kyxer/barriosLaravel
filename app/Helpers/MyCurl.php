<?php
/**
 * Created by PhpStorm.
 * User: German
 * Date: 15/07/2015
 * Time: 06:44 PM
 */

namespace App\Helpers;


class MyCurl
{
    public static function sendPost($url, $post_fields, $headers = NULL) {

        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        if(!is_null($headers))
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);

        $out = curl_exec($curl);

        if(curl_errno($curl)){
            die(var_dump($curl));
        }

        curl_close ($curl);

        return json_decode($out,true);
    }
}