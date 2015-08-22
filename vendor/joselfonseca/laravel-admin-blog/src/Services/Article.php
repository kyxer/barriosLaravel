<?php


namespace Joselfonseca\LaravelAdminBlog\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends  Model
{

    use SoftDeletes;

    protected $table = 'articles';
    protected $fillable = ['user_id', 'title', 'slug', 'intro', 'body', 'image', 'published'];

    public function tags() {
        return $this->morphToMany('Joselfonseca\LaravelAdminBlog\Services\Tag', 'taggables');
    }

    public function categories() {
        return $this->morphToMany('Joselfonseca\LaravelAdminBlog\Services\Category', 'categoryables');
    }

    public function getFields(){
        return [
            'ID', 'Titulo', 'Slug'
        ];
    }

    public function getRows(){
        $data = [];
        $this->get()->each(function($article) use (&$data){
            $data[] = [
                'id' => $article->id,
                'name' => $article->title,
                'slug' => $article->slug
            ];
        });
        return $data;
    }

    public function getTagsSelected()
    {
        $data = [];
        $this->tags->each(function($tag) use(&$data){
            $data[] = $tag->id;
        });
        return $data;
    }

    public function getCategoriesSelected()
    {
        $data = [];
        $this->categories->each(function($category) use(&$data){
            $data[] = $category->id;
        });
        return $data;
    }

    public function tagsForKeywords()
    {
        $string = "";
        $this->tags->each(function($tag) use(&$string){
            $string .= $tag->name.',';
        });
        return $string;
    }


} 
