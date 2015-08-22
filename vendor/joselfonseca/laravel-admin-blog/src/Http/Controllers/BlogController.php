<?php

namespace Joselfonseca\LaravelAdminBlog\Http\Controllers;

use Joselfonseca\LaravelAdminBlog\Services\Article;
use Joselfonseca\LaravelAdminBlog\Services\ArticlesService;
use Joselfonseca\LaravelAdminBlog\Services\Category;
use Joselfonseca\LaravelAdminBlog\Services\Tag;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdminBlog\Http\Requests;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;

class BlogController extends Controller
{

    private $model;
    private $service;

    public function __construct(Article $model, ArticlesService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(TableBuilder $table)
    {
        $table->setActions([
            'edit' => [
                'link' => url('backend/blog/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'delete' => [
                'link' => url('backend/blog/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm',
                'confirm' => true,
            ],
        ]);
        return view('LaravelAdminBlog::index')
            ->with('table', $table->setModel($this->model)->render())
            ->with('activeMenu', 'sidebar.Blog.List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = new Category();
        $tags = new Tag();
        return view('LaravelAdminBlog::.create')
            ->with('categories', $categories->forSelect())
            ->with('tags', $tags->forSelect())
            ->with('activeMenu', 'sidebar.Blog.List');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateBlogRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $model = $this->service->create($data);
        flash()->success('Se ha generado el articulo');
        return redirect()->to('backend/blog');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        $categories = new Category;
        $tags = new Tag;
        return view('LaravelAdminBlog::.edit')
            ->with('categories', $categories->forSelect())
            ->with('tags', $tags->forSelect())
            ->with('article', $model)
            ->with('activeMenu', 'sidebar.Blog.List');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\CreateBlogRequest $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $this->service->edit($id, $data);
        flash()->success('Se ha editado el articulo');
        return redirect()->to('backend/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        flash()->success('Se ha eliminado el artículo');
        return redirect()->to('backend/blog');
    }
}
