<?php

namespace GIS\ArticlePages\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        Gate::authorize("viewAny", $articleModelClass);
        return view("ap::admin.articles.index");
    }

    public function show(ArticleModelInterface $article): View
    {
        Gate::authorize("viewAny", $article::class);
        return view("ap::admin.articles.show", compact("article"));
    }
}
