<?php

namespace App\Http\Controllers\Frontend\Forums;

use Illuminate\Http\Request;
use App\Barrio;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ForumsController extends Controller
{
    //
    public function getIndex($url_name){
        $barrio = Barrio::where('url_name','=',$url_name)->first();
        if(!$barrio){
            return view('errors.404');
        }
        $data                  = [];
        $data['barrio']        = $barrio;
        $data['general']       = 1;
        $data['dashboardAuth'] = 1;
        return view('frontend.forums.index', $data);
    }
}
