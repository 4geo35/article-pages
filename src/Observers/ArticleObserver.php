<?php

namespace GIS\ArticlePages\Observers;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;

class ArticleObserver
{
    public function deleting(ArticleModelInterface $article): void
    {
        foreach ($article->blocks as $block) {
            /**
             * @var ArticleBlockModelInterface $block
             */
            $block->delete();
        }
    }
}
