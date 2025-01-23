<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("articles")
            ->as("articles.")
            ->group(function () {
                Route::get("/", function () {
                    return view("ap::admin.articles.index");
                })->name("index");
                // TODO: add middleware
            });
    });
