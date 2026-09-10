<?php

namespace GIS\ArticlePages\Console\Commands;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ClearArticleImages extends Command
{
    protected $signature = 'article:clear-images {--all} {--cover} {--blocks}';
    protected $description = 'Clear article images';

    public function handle(): void
    {
        $clearAll = $this->option('all');
        $clearCover = $this->option('cover');
        $clearBlocks = $this->option('blocks');

        if (! $clearAll && ! $clearCover && ! $clearBlocks) {
            $this->error("No options selected!");
            return;
        }

        $articles = $this->getArticleList();
        if (!$this->confirm("Found {$articles->count()} articles. Are you sure you want to continue?")) {
            return;
        }

        $total = $articles->count();
        foreach ($articles as $article) {
            if ($clearAll || $clearCover) { $this->clearArticleCover($article); }
            if ($clearAll || $clearBlocks) { $this->clearArticleBlocks($article); }
            $total--;
            $this->info("{$total} remaining");
        }
    }

    protected function clearArticleCover(ArticleModelInterface $article): void
    {
        $this->info("Clear cover for {$article->id} - {$article->slug} - {$article->title}");
        try {
            $article->clearImage();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    protected function clearArticleBlocks(ArticleModelInterface $article): void
    {
        $this->info("Clear blocks for {$article->id} - {$article->slug} - {$article->title}");
        foreach ($article->blocks as $block) {
            /**
             * @var ArticleBlockModelInterface $block
             */
            $type = $block->type;
            switch ($type) {
                case "single_image":
                case "gallery":
                    $block->delete();
                    break;

                case "image_text":
                    $block->clearImage();
                    $block->update([
                        "type" => "text",
                    ]);
                    break;

                case "text":
                case "request_form":
                    break;

                default:
                    $this->error("Unknown block type {$type}");
                    break;
            }
        }
    }

    protected function getArticleList(): EloquentCollection
    {
        $modelClass = config("article-pages.customArticleModel") ?? Article::class;
        return $modelClass::query()
            ->with("blocks", "image")
            ->get();
    }
}
