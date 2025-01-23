<?php

namespace GIS\ArticlePages\Models;

use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Traits\ShouldMeta;
use GIS\TraitsHelpers\Traits\ShouldHumanDate;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements ArticleModelInterface
{
    use HasFactory, ShouldSlug, ShouldHumanDate, ShouldImage, ShouldMeta;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "published_at",
    ];
}
