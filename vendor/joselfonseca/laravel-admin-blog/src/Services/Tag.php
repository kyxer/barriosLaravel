<?php

namespace Joselfonseca\LaravelAdminBlog\Services;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{

    use PresentableTrait,
        SoftDeletes;

    protected $table = 'tags';
    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        return $this->morphedByMany('Joselfonseca\LaravelAdminBlog\Services\Article', 'taggables');
    }

    public function getFields(){
        return [
            'ID', 'Titulo', 'Slug'
        ];
    }

    public function getRows(){
        $data = [];
        $this->get()->each(function($tag) use (&$data){
            $data[] = [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug
            ];
        });
        return $data;
    }

    public static function processTagsToArray($tagString, $returnModel = false)
    {
        $tags = explode(',', $tagString);
        array_walk($tags, function (&$tag) {
            trim($tag);
        });
        if (!empty($returnModel)) {
            return static::trasnlateToModels($tags);
        }
        return static::trasnlateToIds($tags);
    }

    public static function trasnlateToIds($tags)
    {
        array_walk($tags, function (&$tag) {
            $t = Tag::firstOrCreate(['name' => $tag]);
            $tag = $t->id;
        });
        return $tags;
    }

    public static function trasnlateToModels($tags)
    {
        array_walk($tags, function (&$tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
        });
        return $tags;
    }

    public function searchByTag($tag, $taggable)
    {
        $tag = $this->where('slug', '=', $tag)->firstOrFail();
        return ['tag' => $tag, 'collection' => $tag->{$taggable}()->orderBy('created_at', 'desc')->where('published', '=', '1')->get()];
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