<?php

namespace GIS\ArticlePages;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use GIS\ArticlePages\Models\ArticleBlock;
use GIS\ArticlePages\Observers\ArticleBlockObserver;
use GIS\ArticlePages\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use GIS\ArticlePages\Livewire\Admin\Articles\IndexWire as ArticleIndexWire;
use GIS\ArticlePages\Livewire\Admin\Articles\ShowWire as ArticleShowWire;
use GIS\ArticlePages\Livewire\Admin\ArticleBlocks\IndexWire as ArticleBlockIndexWire;

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

        // Observers
        $articleObserverClass = config("article-pages.customArticleModelObserver") ?? ArticleObserver::class;
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $articleModelClass::observe($articleObserverClass);

        $blockObserverClass = config("article-pages.customArticleBlockModelObserver") ?? ArticleBlockObserver::class;
        $blockModelClass = config("article-pages.customArticleBlockModel") ?? ArticleBlock::class;
        $blockModelClass::observe($blockObserverClass);
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

        $component = config("article-pages.customArticleShowComponent");
        Livewire::component(
            "ap-article-show",
            $component ?? ArticleShowWire::class
        );

        // Blocks
        $component = config("article-pages.customArticleBlockIndexComponent");
        Livewire::component(
            "ap-article-block-index",
            $component ?? ArticleBlockIndexWire::class
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
