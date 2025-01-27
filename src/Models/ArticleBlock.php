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
        if (! empty(config("article-pages.blockTypesList")[$this->type]))
            return __(config("article-pages.blockTypesList")[$this->type]);
        else return "";
    }

    public function getMarkdownAttribute(): ?string
    {
        $value = $this->description;
        if (! $value) return $value;
        return Str::markdown($value);
    }
}
