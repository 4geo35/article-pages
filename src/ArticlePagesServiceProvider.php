<?php

namespace GIS\ArticlePages;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
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

        // Расширить конфигурацию
        $this->expandConfiguration();
    }

    public function register(): void
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Config
        $this->mergeConfigFrom(__DIR__ . "/config/article-pages.php", "article-pages");

        // Routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Translations
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");

        // Bindings
        $this->bindInterfaces();
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

    protected function expandConfiguration(): void
    {
        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        $ap = app()->config["article-pages"];
        $permissions[] = [
            "title" => $ap["articlePolicyTitle"],
            "policy" => $ap["articlePolicy"],
            "key" => $ap["articlePolicyKey"],
        ];
        app()->config["user-management.permissions"] = $permissions;
    }

    protected function bindInterfaces(): void
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $this->app->bind(ArticleModelInterface::class, $articleModelClass);
    }
}
