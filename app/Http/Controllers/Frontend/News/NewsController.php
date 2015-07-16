<?php

namespace App\Http\Controllers\Frontend\News;

use Illuminate\Http\Request;
use App\Barrio;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function getIndex($url_name){
        $barrio = Barrio::where('url_name','=',$url_name)->first();

        if(!$barrio){
            return view('errors.404');
        }

        return view('frontend.news.index',['barrio'=>$barrio]);


    }
}
