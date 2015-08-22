<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class BlogController extends Controller
{
    public function getIndex(){
        $data = [];
        if(Auth::check())
            $data['dashboardAuth'] = 1;
        else
            $data['auth'] = 1;

        $data['general'] = 1;

        return view('frontend.blog.index', $data);
    }
}
