<?php

namespace GIS\ArticlePages\Livewire\Admin\Articles;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Traits\ArticleEditTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowWire extends Component
{
    use ArticleEditTrait, WithFileUploads;

    public ArticleModelInterface $article;

    public function render(): View
    {
        if (config("article-labels")) {
            $articleLabels = $this->article->labels()->orderBy("priority")->get();
        } else {
            $articleLabels = null;
        }
        return view('ap::livewire.admin.articles.show-wire', compact("articleLabels"));
    }
}
