<?php

namespace GIS\ArticlePages\Observers;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\ArticlePages\Models\ArticleBlock;

class ArticleBlockObserver
{
    public function creating(ArticleBlockModelInterface $block): void
    {
        $blockModelClass = config("article-pages.customArticleBlockModel") ?? ArticleBlock::class;
        $priority = $blockModelClass::query()
            ->select("id", "priority")
            ->where("article_id", $block->article_id)
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $block->priority = $priority + 1;
    }
}
