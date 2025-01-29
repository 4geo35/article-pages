<?php

namespace GIS\ArticlePages\Livewire\Web\Articles;

use GIS\ArticlePages\Models\Article;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination;

    public function render(): View
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $articles = $articleModelClass::query()
            ->whereNotNull("published_at")
            ->where("published_at", "<", now(date_helper()->timeZone))
            ->with("image")
            ->orderBy("fixed_at", "desc")
            ->orderBy("published_at", "desc")
            ->paginate();
        return view('ap::livewire.web.articles.index-wire', compact("articles"));
    }
}
