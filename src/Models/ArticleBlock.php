<?php

namespace GIS\ArticlePages\Models;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\Fileable\Traits\ShouldGallery;
use GIS\Fileable\Traits\ShouldImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ArticleBlock extends Model implements ArticleBlockModelInterface
{
    use HasFactory, ShouldImage, ShouldGallery;

    protected $fillable = [
        "title",
        "type",
        "description",
    ];

    public function article(): BelongsTo
    {
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        return $this->belongsTo($articleModelClass, "article_id");
    }

    public function getTypeTitleAttribute(): string
    {
        return match ($this->type) {
            "text" => __("Text"),
            "image_text" => __("Text + Image"),
            "gallery" => __("Image gallery"),
            "single_image" => __("Image"),
        };
    }

    public function getMarkdownAttribute(): ?string
    {
        $value = $this->description;
        if (! $value) return $value;
        return Str::markdown($value);
    }
}
