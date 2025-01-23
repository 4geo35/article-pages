<?php

namespace GIS\ArticlePages;

use Illuminate\Support\ServiceProvider;

class ArticlePagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

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
}
