<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use Auth;
use User;
use Request;
use Illuminate\Http\Request as RequestHttp;
use Illuminate\Support\Facades\Session;
use App\Barrio;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            $data = [];
            $barrio = Barrio::where('postal_code','=',Auth::user()->postal_code)->first();
            if($barrio){
                Session::put('barrio', $barrio);
            }else{
                Session::forget('barrio');
            }
            if(Session::get('register')){
                Session::forget('register');
                $data['register'] = 1;
            }

            return view('frontend.dashboard.homeAuth',$data);
        }
        else{
            return view('frontend.dashboard.home');
        }

    }

    public function getBarrio($url_barrio)
    {

        $barrio = Barrio::where('url_name','=',$url_barrio)->first();
        if(!$barrio){
            return view('errors.404');
        }
        return view('frontend.dashboard.barrio',['barrio'=>$barrio]);


    }

    public function postSearchBarrio(RequestHttp $request){
        $this->validate($request, [
            'postal_code' => 'required|max:5|min:5'
        ]);
        $barrio = Barrio::where('postal_code','=',Request::input('postal_code'))->first();
        if(!$barrio){
            Session::forget('barrio_search');
            return redirect('not-found');
        }
        Session::put('barrio_search', $barrio);
        return redirect($barrio['url_name']);

    }
}
