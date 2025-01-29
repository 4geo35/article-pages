<?php

namespace GIS\ArticlePages\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
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
        if (! $article->published_at) abort(404);
        if ($article->published_at > now(date_helper()->timeZone)) abort(404);

        $metas = MetaActions::renderByModel($article);

        $blocks = $article->blocks()->orderBy("priority")->get();
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $more = $articleModelClass::query()
            ->whereNotNull("published_at")
            ->where("published_at", "<", now(date_helper()->timeZone))
            ->where("id", "!=", $article->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view("ap::web.articles.show", compact("article", "metas", "blocks", "more"));
    }
}
