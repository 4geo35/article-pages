<?php

namespace GIS\ArticlePages\Livewire\Admin\Articles;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use GIS\ArticlePages\Traits\ArticleEditTrait;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination, WithFileUploads, ArticleEditTrait;

    public string $searchTitle = "";

    protected function queryString(): array
    {
        return [
            "searchTitle" => ["as" => "title", "except" => ""],
        ];
    }

    public function render(): View
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $query = $articleModelClass::query();
        BuilderActions::extendLike($query, $this->searchTitle, "title");
        $query->orderBy("created_at", "desc");
        $articles = $query->paginate();
        return view('ap::livewire.admin.articles.index-wire', compact("articles"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchTitle");
        $this->resetPage();
    }

    public function showCreate(): void
    {
        // TODO: add check auth
        $this->resetFields();
        $this->displayData = true;
    }

    public function store(): void
    {
        // TODO: add check auth
        $this->validate();

        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
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
