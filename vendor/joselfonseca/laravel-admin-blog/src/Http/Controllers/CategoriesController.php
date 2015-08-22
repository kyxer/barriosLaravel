<?php

namespace Joselfonseca\LaravelAdminBlog\Http\Controllers;

use Joselfonseca\LaravelAdminBlog\Http\Requests;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdminBlog\Http\Requests\CreateCategoryRequest;
use Joselfonseca\LaravelAdminBlog\Services\Category;

class CategoriesController extends Controller {

    private $model;
    private $table;

    public function __construct(TableBuilder $table, Category $model)
    {
        $this->model = $model;
        $this->table = $table;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $this->table->setActions([
            'edit' => [
                'link' => url('backend/blog-categories/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'delete' => [
                'link' => url('backend/blog-categories/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm',
                'confirm' => true,
            ],
        ]);
        return view('LaravelAdminBlog::categories.index')
            ->with('table', $this->table->setModel($this->model)->render())
            ->with('activeMenu', 'sidebar.Blog.Categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('LaravelAdminBlog::categories.create')
            ->with('activeMenu', 'sidebar.Blog.Categories');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCategoryRequest $request)
	{
        $this->model->create($request->all());
        flash()->success('Se ha creado la Categoría');
        return redirect()->to('backend/blog-categories');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $category = $this->model->findOrFail($id);
        return view('LaravelAdminBlog::categories.edit')
            ->with('category', $category)
            ->with('activeMenu', 'sidebar.Blog.Categories');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreateCategoryRequest $request, $id)
	{
        $category = $this->model->findOrFail($id);
        if($category->name !== $request->get('name')){
            $category->generateNewSlug = true;
        }
        $category->fill($request->all());
        $category->save();
        flash()->success('Se ha actualizado la Categoria');
        return redirect()->to('backend/blog-categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $category = $this->model->findOrFail($id);
        $category->delete();
        flash()->success('Se ha eliminado la categoría');
        return redirect()->to('backend/blog-categories');
	}

}
