<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("articles")
            ->as("articles.")
            ->group(function () {
                $articleControllerClass = config("article-pages.customArticleAdminController") ?? \GIS\ArticlePages\Http\Controllers\Admin\ArticleController::class;
                Route::get("/", [$articleControllerClass, "index"])->name("index");
                Route::get("/{article}", [$articleControllerClass, "show"])->name("show");
            });
    });
