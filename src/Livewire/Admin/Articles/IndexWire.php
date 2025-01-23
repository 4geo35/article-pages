<?php

namespace GIS\ArticlePages\Livewire\Admin\Articles;

use Illuminate\View\View;
use Livewire\Component;

class IndexWire extends Component
{
    public function render(): View
    {
        return view('ap::livewire.admin.articles.index-wire');
    }
}
