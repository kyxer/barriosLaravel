<?php
/**
* Author: German Mendoza
* Twitter: german0296
* Description: Controller for handle activities in barrios
*/
namespace App\Http\Controllers\Frontend\Activities;

use Illuminate\Http\Request;
use App\Barrio;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    /**
     * Function to show index Activities
     * @param  string $url_name
     * @return view
     */
    public function getIndex($url_name){

        $barrio = Barrio::where('url_name','=',$url_name)->first();
        if(!$barrio){
            return view('errors.404');
        }
        $data                  = [];
        $data['barrio']        = $barrio;
        $data['general']       = 1;
        $data['dashboardAuth'] = 1;

        return view('frontend.activities.index',$data);

    }
}
