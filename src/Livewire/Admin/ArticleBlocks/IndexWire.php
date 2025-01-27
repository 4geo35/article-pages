<?php

namespace GIS\ArticlePages\Livewire\Admin\ArticleBlocks;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use Illuminate\View\View;
use Livewire\Component;

class IndexWire extends Component
{
    public ArticleModelInterface $article;

    public function render(): View
    {
        return view('ap::livewire.admin.article-blocks.index-wire');
    }
}
