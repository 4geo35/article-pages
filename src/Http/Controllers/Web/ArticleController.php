<?php

namespace GIS\ArticlePages\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\Metable\Facades\MetaActions;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $metas = MetaActions::renderByPage(config("article-pages.pagePrefix"));
        return view("ap::web.articles.index", compact("metas"));
    }

    public function show(ArticleModelInterface $article): View
    {
        return view("ap::web.articles.show", compact("article"));
    }
}
