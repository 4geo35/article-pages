<?php

namespace GIS\ArticlePages\Livewire\Admin\Articles;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use GIS\ArticlePages\Traits\ArticleEditTrait;
use GIS\TraitsHelpers\Facades\BuilderActions;
use GIS\TraitsHelpers\Traits\WireDeleteImageTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination, WithFileUploads, ArticleEditTrait, WireDeleteImageTrait;

    public string $searchTitle = "";
    public string $searchFixed = "all";

    protected function queryString(): array
    {
        return [
            "searchTitle" => ["as" => "title", "except" => ""],
            "searchFixed" => ["as" => "fixed", "except" => "all"],
        ];
    }

    public function render(): View
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $query = $articleModelClass::query();
        if (config("article-labels")) $query->with("labels:id,title");
        BuilderActions::extendLike($query, $this->searchTitle, "title");
        if (trim($this->searchFixed) === "yes") $query->whereNotNull("fixed_at");
        if (trim($this->searchFixed) === "no") $query->whereNull("fixed_at");
        $query->orderBy("created_at", "desc");
        $articles = $query->paginate();
        return view('ap::livewire.admin.articles.index-wire', compact("articles"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchTitle", "searchFixed");
        $this->resetPage();
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) return;
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) return;
        $this->validate();

        $articleModelClass = config("article-pages.customLabelModel") ?? Article::class;
        $article = $articleModelClass::create([
            "title" => $this->title,
            "slug" => $this->title,
            "short" => $this->short,
        ]);
        /**
         * @var ArticleModelInterface $article
         */
        $article->livewireImage($this->cover);

        $this->closeData();
        $this->resetPage();
        $this->redirectRoute("admin.articles.show", ["article" => $article]);
    }
}
