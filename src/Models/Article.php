<?php

namespace GIS\ArticlePages\Models;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\Fileable\Interfaces\ShouldImageInterface;
use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Interfaces\ShouldMetaInterface;
use GIS\Metable\Traits\ShouldMeta;
use GIS\TraitsHelpers\Traits\ShouldHumanDate;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model implements ArticleModelInterface
{
    use HasFactory, ShouldSlug, ShouldHumanDate, ShouldImage, ShouldMeta;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "published_at",
        "fixed_at",
    ];

    public function blocks(): HasMany
    {
        $blockModelClass = config("article-pages.customArticleBlockModel") ?? ArticleBlock::class;
        return $this->hasMany($blockModelClass, "article_id");
    }

    public function getPublishedHumanAttribute()
    {
        $value = $this->published_at;
        if (empty($value)) return $value;
        return date_helper()->format($value);
    }
}
