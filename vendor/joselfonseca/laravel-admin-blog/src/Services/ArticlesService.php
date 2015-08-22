<?php


namespace Joselfonseca\LaravelAdminBlog\Services;

use Joselfonseca\LaravelAdminBlog\Events\ArticleWasCreated;
use Joselfonseca\LaravelAdminBlog\Events\ArticleWasUpdated;
use Joselfonseca\LaravelAdminBlog\Services\Article;


class ArticlesService {

    private $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $tags = $data['tags'];
        $categories = $data['categories'];
        unset($data['tags']);
        unset($data['categories']);
        $data['user_id'] = \Auth::user()->id;
        $article = $this->model->create($data);
        $article->tags()->sync($tags);
        $article->categories()->sync($categories);
        event(new ArticleWasCreated($article));
        return $article;
    }

    public function edit($id, $data)
    {
        $tags = $data['tags'];
        $categories = $data['categories'];
        unset($data['tags']);
        unset($data['categories']);
        $article = $this->model->findOrFail($id);
        if($article->title !== $data['title']){
            $article->generateNewSlug = true;
        }
        $article->fill($data);
        $article->save();
        $article->tags()->sync($tags);
        $article->categories()->sync($categories);
        event(new ArticleWasUpdated($article));
        return $article;
    }

    public function destroy($id)
    {
        $article = $this->model->findOrFail($id);
        return $article->delete();
    }

} 