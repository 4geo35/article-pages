<?php

use Illuminate\Support\Facades\Route;
use GIS\ArticlePages\Http\Controllers\Admin\ArticleController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("articles")
            ->as("articles.")
            ->group(function () {
                $articleControllerClass = config("article-pages.customArticleAdminController") ?? ArticleController::class;
                Route::get("/", [$articleControllerClass, "index"])->name("index");
                Route::get("/{article}", [$articleControllerClass, "show"])->name("show");
            });
    });
