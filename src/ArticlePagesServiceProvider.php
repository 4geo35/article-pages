<?php

namespace GIS\ArticlePages;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use GIS\ArticlePages\Livewire\Admin\Articles\IndexWire as ArticleIndexWire;

class ArticlePagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "ap");

        // Livewire
        $this->addLivewireComponents();
    }

    public function register(): void
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/article-pages.php", "article-pages");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
    }

    protected function addLivewireComponents(): void
    {
        // Article
        $component = config("article-pages.customArticleIndexComponent");
        Livewire::component(
            "ap-article-index",
            $component ?? ArticleIndexWire::class
        );
    }
}
