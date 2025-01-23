<?php

namespace GIS\ArticlePages\Traits;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait ArticleEditTrait
{
    public bool $displayData = false;
    public bool $displayDelete = false;

    public string $title = "";
    public string $slug = "";
    public string $short = "";
    public string $publishedAt = "";
    public TemporaryUploadedFile|null $cover = null;

    public string|null $coverUrl = null;
    public int|null $articleId = null;

    public function rules(): array
    {
        $uniqueCondition = "unique:articles,slug";
        if ($this->articleId) $uniqueCondition .= ",{$this->articleId}";
        return [
            "title" => ["required", "string", "max:150"],
            "slug" => ["nullable", "string", "max:150", $uniqueCondition],
            "short" => ["nullable", "string", "max:250"],
            "cover" => ["nullable", "image"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => __("Title"),
            "slug" => __("Slug"),
            "short" => __("Short description"),
            "cover" => __("Cover"),
        ];
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showEdit(int $articleId): void
    {
        $this->resetFields();
        $this->articleId = $articleId;
        $article = $this->findArticle();
        if (! $article) return;

        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->short = $article->short;
        $this->displayData = true;
        if ($article->image_id) {
            $article->load("image");
            $this->coverUrl = $article->image->storage;
        } else $this->coverUrl = null;
    }

    protected function findArticle(): ?ArticleModelInterface
    {
        if (isset($this->article)) return $this->article;
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $article = $articleModelClass::find($this->articleId);
        if (! $article) {
            session()->flash("error", __("Article not found"));
            $this->closeData();
            return null;
        }
        return $article;
    }

    protected function resetFields(): void
    {
        $this->reset(["title", "slug", "short", "publishedAt", "cover", "coverUrl", "articleId"]);
    }
}
