<?php

namespace GIS\ArticlePages\Traits;

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

    protected function resetFields(): void
    {
        $this->reset(["title", "slug", "short", "publishedAt", "cover", "coverUrl", "articleId"]);
    }
}
