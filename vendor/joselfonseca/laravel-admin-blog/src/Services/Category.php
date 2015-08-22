<?php


namespace Joselfonseca\LaravelAdminBlog\Services;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        return $this->morphedByMany('Joselfonseca\LaravelAdminBlog\Services\Article', 'categoryables');
    }

    public function getFields(){
        return [
            'ID', 'Titulo', 'Slug'
        ];
    }

    public function getRows(){
        $data = [];
        $this->get()->each(function($category) use (&$data){
            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug
            ];
        });
        return $data;
    }

    public static function processCategoriesToArray($categoryString, $returnModel = false)
    {
        $categories = explode(',', $categoryString);
        array_walk($categories, function (&$category) {
            trim($category);
        });
        if (!empty($returnModel)) {
            return static::trasnlateToModels($categories);
        }
        return static::trasnlateToIds($categories);
    }

    public static function trasnlateToIds($categories)
    {
        array_walk($categories, function (&$category) {
            $t = Category::firstOrCreate(['name' => $category]);
            $category = $t->id;
        });
        return $categories;
    }

    public static function trasnlateToModels($tags)
    {
        array_walk($categories, function (&$category) {
            $category = Category::firstOrCreate(['name' => $category]);
        });
        return $categories;
    }

    public function searchByCategory($category, $categoryable, $limit = 5)
    {
        $category = $this->where('slug', '=', $category)->firstOrFail();
        return ['category' => $category, 'collection' => $category->{$categoryable}()->orderBy('created_at', 'desc')->where('published', '=', '1')->paginate(20)];
    }

    public function forSelect()
    {
        $data = [];
        $this->orderBy('name')->get()->each(function ($cate) use (&$data) {
            $data[$cate->id] = $cate->name;
        });
        return $data;
    }
} 