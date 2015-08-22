<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\MyDate;

use Auth;
use Joselfonseca\LaravelAdminBlog\Services\Article as Article;

class BlogController extends Controller
{
    public function getIndex(){
        $data = [];
        if(Auth::check())
            $data['dashboardAuth'] = 1;
        else
            $data['auth'] = 1;

        $data['general'] = 1;
        $articles = Article::where('published',1)
        ->select('users.first_name', 'users.id as user_id', 'title',
            'slug', 'intro', 'body',
            'image','articles.created_at')
        ->leftJoin('users', 'users.id', ' =', 'user_id')
        ->orderBy('articles.created_at', 'DESC')
        ->take(3)
        ->get()
        ->toArray();

        foreach ($articles as &$value) {
            $value['month'] = MyDate::getMonth($value['created_at']);
            $value['day'] = MyDate::getDay($value['created_at']);
            $value['spent_days'] = MyDate::getSpentDays($value['created_at']);
        }
        $data['articles'] = $articles;
        return view('frontend.blog.index', $data);
    }

    public function getArticle($slug){
        $data = [];
        if(Auth::check())
            $data['dashboardAuth'] = 1;
        else
            $data['auth'] = 1;

        $data['general'] = 1;

        $articles = Article::where('slug',$slug)
        ->select('users.first_name', 'users.id as user_id', 'title',
            'slug', 'intro', 'body',
            'image','articles.created_at')
        ->leftJoin('users', 'users.id', ' =', 'user_id')
        ->take(1)
        ->get()
        ->toArray();

        if(!count($articles))
            return view('errors.404');

        foreach ($articles as &$value) {
            $value['month'] = MyDate::getMonth($value['created_at']);
            $value['day'] = MyDate::getDay($value['created_at']);
            $value['spent_days'] = MyDate::getSpentDays($value['created_at']);
        }

        $data['article'] = $articles[0];
        $data['single'] = 1;
        return view('frontend.blog.single', $data);
    }
}
