<?php

namespace App\Http\Controllers\Frontend\Activities;

use Illuminate\Http\Request;
use App\Barrio;
use Auth;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    //
    public function getIndex($url_name){

        $barrio = Barrio::where('url_name','=',$url_name)->first();

        if(!$barrio){
            return view('errors.404');
        }

        return view('frontend.activities.index',['barrio'=>$barrio]);

    }
}
