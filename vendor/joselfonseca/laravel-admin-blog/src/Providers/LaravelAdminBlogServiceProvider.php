<?php

namespace Joselfonseca\LaravelAdminBlog\Providers;

use Illuminate\Support\ServiceProvider;
use Joselfonseca\LaravelAdminBlog\Services\Article;
use Joselfonseca\LaravelAdminBlog\Services\Tag;
use Joselfonseca\LaravelAdminBlog\Services\Category;
use Joselfonseca\LaravelAdmin\Services\Slug\SlugGeneratorObserver;
use Illuminate\Foundation\AliasLoader;


class LaravelAdminBlogServiceProvider extends ServiceProvider{

    protected $providers = [
        'Pqb\FilemanagerLaravel\FilemanagerLaravelServiceProvider',
    ];
    protected $aliases = [
        'FilemanagerLaravel'=> 'Pqb\FilemanagerLaravel\Facades\FilemanagerLaravel',
    ];

    public function register()
    {
        $this->registerOtherProviders()
            ->registerAliases()
            ->loadViewsConfiguration()
            ->publishMigrations();
    }

    public function boot()
    {
        $menu = $this->app->make('admin.menu');
        $menu->addMenu([
            'Blog' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-newspaper-o fa-lg"></i> Blog de noticias',
                ],
                'permissions' => ['blog-admin'],
                'submenus' => [
                    'List' => [
                        'link' => [
                            'link' => 'backend/blog',
                            'text' => 'Articulos',
                        ],
                        'permissions' => ['blog-admin'],
                    ],
                    'Categories' => [
                        'link' => [
                            'link' => 'backend/blog-categories',
                            'text' => 'Categorías',
                        ],
                        'permissions' => ['blog-admin'],
                    ],
                    'Tags' => [
                        'link' => [
                            'link' => 'backend/blog-tags',
                            'text' => 'Tags',
                        ],
                        'permissions' => ['blog-admin'],
                    ]
                ]
            ]
        ]);
        $this->loadRoutes();
        Article::observe(new SlugGeneratorObserver());
        Category::observe(new SlugGeneratorObserver());
        Tag::observe(new SlugGeneratorObserver());
    }

    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        return $this;
    }

    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
        }

        return $this;
    }

    private function loadRoutes()
    {
        include __DIR__ . '/../Http/routes.php';

        return $this;
    }

    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views/', 'LaravelAdminBlog');
        $this->publishes([
            __DIR__ . '/../Views/' => base_path('resources/views/vendor/LaravelAdminBlog'),
        ]);
        return $this;
    }

    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../../migrations/' => base_path('database/migrations'),
        ]);
        return $this;
    }

}