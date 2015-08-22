<?php

Route::group(['prefix' => 'backend', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => 'acl:blog-admin'], function () {
        /** Blog  **/
        Route::get('blog/{id}/delete', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\BlogController@destroy');
        Route::resource('blog', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\BlogController');
        /** Categorias **/
        Route::get('blog-categories/{id}/delete', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\CategoriesController@destroy');
        Route::resource('blog-categories', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\CategoriesController');
        /** Tags **/
        Route::get('blog-tags/{id}/delete', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\TagsController@destroy');
        Route::resource('blog-tags', 'Joselfonseca\LaravelAdminBlog\Http\Controllers\TagsController');
    });
});