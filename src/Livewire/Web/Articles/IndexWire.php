<?php

namespace GIS\ArticlePages\Livewire\Web\Articles;

use GIS\ArticleLabels\Models\ArticleLabel;
use GIS\ArticlePages\Models\Article;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination;

    public array $searchLabel = [];

    protected function queryString(): array
    {
        return [
            "searchLabel" => ["as" => "label", "except" => ""],
        ];
    }

    public function render(): View
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $query = $articleModelClass::query()
            ->whereNotNull("published_at")
            ->where("published_at", "<", now(date_helper()->timeZone));
        if (config("article-labels")) {
            if (! empty($this->searchLabel)) {
                $query->whereHas("labels", fn($q) => $q->whereIn("slug", $this->searchLabel));
            }
            $query->with([
                "image", "labels" => function ($builder) {
                    $builder->select("id", "title", "slug");
                    $builder->orderBy("priority");
                }
            ]);
        } else {
            $query->with("image");
        }
        $query->orderBy("fixed_at", "desc")
            ->orderBy("published_at", "desc");
        $articles = $query->paginate();

        if (config("article-labels")) {
            $labelModelClass = config("article-labels.customLabelModel") ?? ArticleLabel::class;
            $labels = $labelModelClass::query()
                ->select("id", "title", "slug")
                ->orderBy("priority")
                ->get();
        } else {
            $labels = null;
        }
        return view('ap::livewire.web.articles.index-wire', compact("articles", "labels"));
    }

    public function switchLabel(string $slug): void
    {
        $this->resetPage();
        if (in_array($slug, $this->searchLabel)) {
            $this->searchLabel = array_diff($this->searchLabel, [$slug]);
        } else {
            $this->searchLabel[] = $slug;
        }
    }
}
