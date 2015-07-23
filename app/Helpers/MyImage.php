<?php
/**
 * Created by PhpStorm.
 * User: German
 * Date: 15/07/2015
 * Time: 06:02 PM
 */

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Input;
use Image;
use Request;


class MyImage
{
    protected static function tempnamSfx($path, $suffix){

        $i = 50;
        do
        {

            $file = $path.'/'.str_random(20).'.'.$suffix;


            //die(var_dump($file));
            $fp = @fopen($file, 'x+');
            $i--;
        }
        while(!$fp && $i>0);

        fclose($fp);
        return $file;
    }

    protected static function nameThumb($source_image){

        $arr = explode('.',$source_image);
        return implode("_thumb.", $arr);
    }

    protected static function createThumb($source_image, $width = 80, $height = 80 ){
        // create instance
        $img = Image::make($source_image);

        // resize image to fixed size
        $img->resize($width, $height);

        // save file as png with medium quality
        $img->save(MyImage::nameThumb($source_image), 60);
    }

    protected static function publicNameAvatar($avatar){
        $arr = explode('/',$avatar);
        $name = array_pop($arr);

        return asset('/assets/uploads/'.$name);
    }

    protected static function localNameAvatar($avatar){
        $arr = explode('/',$avatar);
        $name = array_pop($arr);

        return public_path('/assets/uploads/'.$name);
    }

    protected static function moveAvatars($source_image){

        $img = Image::make($source_image);
        $avatar['avatar_standar'] = MyImage::tempnamSfx(base_path('/assets/uploads'), 'jpg');
        $img->save($avatar['avatar_standar'], 80);
        $avatar['avatar_thumbnail'] = MyImage::nameThumb($avatar['avatar_standar']);
        $img = Image::make(MyImage::nameThumb($source_image));
        $img->save($avatar['avatar_thumbnail'], 80);

        $avatar['avatar_standar'] = MyImage::publicNameAvatar($avatar['avatar_standar']);
        $avatar['avatar_thumbnail'] = MyImage::publicNameAvatar($avatar['avatar_thumbnail']);

        return $avatar;
    }

    public static function uploadAvatar(){

        $tmp_archivo = Input::file('avatar');

        $lienzo_ancho= 150;
        $lienzo_alto = 150;

        $extension = Input::file('avatar')->getClientOriginalExtension();

        $info_imagen = getimagesize($tmp_archivo);
        $imagen_ancho = $info_imagen[0];
        $imagen_alto = $info_imagen[1];

        $lienzo = imagecreatetruecolor($lienzo_ancho, $lienzo_alto );
        $blanco = imagecolorallocate($lienzo, 155, 155, 155);
        imagefill($lienzo, 0, 0, $blanco);


        switch ($extension){
            case "jpg":
            case "jpeg":
                $imagen = imagecreatefromjpeg($tmp_archivo);
                break;
            case "png":
                $imagen = imagecreatefrompng($tmp_archivo);
                break;
            case "gif":
                $imagen = imagecreatefromgif($tmp_archivo);
                break;
            default:
               // $this->response(array('error' => 'Wrong Format'), 400);
        }

        if($imagen_ancho>=$imagen_alto)
        { //imagen horizontal

            $imagen_inicio_ancho=($imagen_ancho/2)-($imagen_alto/2);
            $imagen_inicio_alto=0;
            $imagen_nuevo_ancho=$imagen_alto;
            $imagen_nuevo_alto=$imagen_alto;

        }
        else
        { //imagen vertical

            $imagen_inicio_ancho=0;
            $imagen_inicio_alto=($imagen_alto/2)-($imagen_ancho/2);
            $imagen_nuevo_ancho=$imagen_ancho;
            $imagen_nuevo_alto=$imagen_ancho;

        }

        imagecopyresampled($lienzo, $imagen, 0, 0, $imagen_inicio_ancho, $imagen_inicio_alto, $lienzo_ancho, $lienzo_alto, $imagen_nuevo_ancho, $imagen_nuevo_alto);

        $imageName= MyImage::tempnamSfx(sys_get_temp_dir(), "jpg");
        imagejpeg($lienzo, $imageName, 100);

        MyImage::createThumb($imageName);
        /*$nameThumb = MyImage::nameThumb($imageName);
        $handle = fopen($imageName, "r");
        $data = fread($handle, filesize($imageName));
        $headers = array('Authorization: Client-ID ' . env('IMGUR_CLIENT_ID'));
        $postFields = array('image' => base64_encode($data));

        $dataImage = MyCurl::sendPost(env('IMGUR_UPLOAD_IMAGE_ENDPOINT'), $postFields, $headers);

        $handle = fopen($nameThumb, "r");
        $data = fread($handle, filesize($nameThumb));
        $headers = array('Authorization: Client-ID ' . env('IMGUR_CLIENT_ID'));
        $postFields = array('image' => base64_encode($data));

        $dataThumb = MyCurl::sendPost(env('IMGUR_URL_UPLOAD_IMAGE'), $postFields, $headers);*/


        return MyImage::moveAvatars($imageName);

    }

    public static function deleteAvatar($avatar){
        $arr = explode('/',$avatar);
        $name = array_pop($arr);

        if(strlen($name) < 20 ){
            return true;
        }
        try {
            File::delete(MyImage::localNameAvatar($avatar));
        }catch (Exception $e){

        }finally {
            return true;
        }

    }

    public static function uploadAvatarBase64(){

        $tmp_archivo =file_get_contents(Request::input('avatar'));



        $lienzo_ancho= 150;
        $lienzo_alto = 150;

        $info_imagen = getimagesizefromstring($tmp_archivo);
        $imagen_ancho = $info_imagen[0];
        $imagen_alto = $info_imagen[1];

        $imagen = imagecreatefromstring($tmp_archivo);

        $lienzo = imagecreatetruecolor($lienzo_ancho, $lienzo_alto );
        $blanco = imagecolorallocate($lienzo, 155, 155, 155);
        imagefill($lienzo, 0, 0, $blanco);

        if($imagen_ancho>=$imagen_alto)
        { //imagen horizontal

            $imagen_inicio_ancho=($imagen_ancho/2)-($imagen_alto/2);
            $imagen_inicio_alto=0;
            $imagen_nuevo_ancho=$imagen_alto;
            $imagen_nuevo_alto=$imagen_alto;

        }
        else
        { //imagen vertical

            $imagen_inicio_ancho=0;
            $imagen_inicio_alto=($imagen_alto/2)-($imagen_ancho/2);
            $imagen_nuevo_ancho=$imagen_ancho;
            $imagen_nuevo_alto=$imagen_ancho;

        }

        imagecopyresampled($lienzo, $imagen, 0, 0, $imagen_inicio_ancho, $imagen_inicio_alto, $lienzo_ancho, $lienzo_alto, $imagen_nuevo_ancho, $imagen_nuevo_alto);

        $imageName= MyImage::tempnamSfx(sys_get_temp_dir(), "jpg");
        imagejpeg($lienzo, $imageName, 100);

        MyImage::createThumb($imageName);
        /*$nameThumb = MyImage::nameThumb($imageName);
        $handle = fopen($imageName, "r");
        $data = fread($handle, filesize($imageName));
        $headers = array('Authorization: Client-ID ' . env('IMGUR_CLIENT_ID'));
        $postFields = array('image' => base64_encode($data));

        $dataImage = MyCurl::sendPost(env('IMGUR_UPLOAD_IMAGE_ENDPOINT'), $postFields, $headers);

        $handle = fopen($nameThumb, "r");
        $data = fread($handle, filesize($nameThumb));
        $headers = array('Authorization: Client-ID ' . env('IMGUR_CLIENT_ID'));
        $postFields = array('image' => base64_encode($data));

        $dataThumb = MyCurl::sendPost(env('IMGUR_URL_UPLOAD_IMAGE'), $postFields, $headers);*/


        return MyImage::moveAvatars($imageName);

    }
}