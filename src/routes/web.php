<?php

use Illuminate\Support\Facades\Route;
use GIS\ArticlePages\Http\Controllers\Web\ArticleController;

Route::middleware(["web"])
    ->as("web.articles.")
    ->prefix(config("article-pages.pagePrefix"))
    ->group(function () {
        $articleControllerClass = config("article-pages.customArticleWebController") ?? ArticleController::class;
        Route::get("/", [$articleControllerClass, "index"])->name("index");
        Route::get("/{article}", [$articleControllerClass, "show"])->name("show");
    });
