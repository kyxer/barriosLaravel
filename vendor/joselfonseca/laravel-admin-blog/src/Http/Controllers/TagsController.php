<?php

namespace Joselfonseca\LaravelAdminBlog\Http\Controllers;

use Joselfonseca\LaravelAdminBlog\Http\Requests;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdminBlog\Http\Requests\CreateTagRequest;
use Joselfonseca\LaravelAdminBlog\Services\Tag;

class TagsController extends Controller
{

    private $model;
    private $table;

    public function __construct(TableBuilder $table, Tag $model)
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
                'link' => url('backend/blog-tags/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'delete' => [
                'link' => url('backend/blog-tags/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm',
                'confirm' => true,
            ],
        ]);

        return view('LaravelAdminBlog::tags.index')
            ->with('table', $this->table->setModel($this->model)->render())
            ->with('activeMenu', 'sidebar.Blog.Tags');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('LaravelAdminBlog::tags.create')
            ->with('activeMenu', 'sidebar.Blog.Tags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $this->model->create($request->all());
        flash()->success('Se ha creado el Tag');

        return redirect()->to('backend/blog-tags');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->model->findOrFail($id);

        return view('LaravelAdminBlog::tags.edit')
            ->with('tag', $tag)
            ->with('activeMenu', 'sidebar.Blog.Tags');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(CreateTagRequest $request, $id)
    {
        $tag = $this->model->findOrFail($id);
        if ($tag->name !== $request->get('name')) {
            $tag->generateNewSlug = true;
        }
        $tag->fill($request->all());
        $tag->save();
        flash()->success('Se ha actualizado el Tag');

        return redirect()->to('backend/blog-tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->delete();
        flash()->success('Se ha eliminado el Tag');

        return redirect()->to('backend/blog-tags');
    }

}
