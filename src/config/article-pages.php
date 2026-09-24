<?php

return [
    // Settings
    "pagePrefix" => "articles",
    "useBreadcrumbs" => true,
    "pageTitle" => "Статьи",
    "useH1" => true,
    "disableCoverImage" => false,

    // Models
    "customArticleModel" => null,
    "customArticleModelObserver" => null,

    "customArticleBlockModel" => null,
    "customArticleBlockModelObserver" => null,

    // Controllers
    "customArticleWebController" => null,

    "customArticleAdminController" => null,

    // Wire Components
    "customArticleIndexComponent" => null,
    "customArticleShowComponent" => null,

    "customArticleBlockIndexComponent" => null,

    "customArticleWebIndexComponent" => null,

    // Blocks
    "webBlockTypeTemplates" => [
        "text" => "ap::web.article-blocks.templates.text",
        "image_text" => "ap::web.article-blocks.templates.image-text",
        "gallery" => "ap::web.article-blocks.templates.gallery",
        "single_image" => "ap::web.article-blocks.templates.single-image",
    ],
    "insideTitle" => [], // Блоки, для которых заголовок должен быть внутри

    "blockTypesList" => [
        "text" => env("ARTICLE_BLOCK_TEXT_TITLE", "Text"),
        "image_text" => env("ARTICLE_BLOCK_IMAGE_TEXT_TITLE", "Text + Image"),
        "gallery" => env("ARTICLE_BLOCK_IMAGE_GALLERY_TITLE", "Image gallery"),
        "single_image" => env("ARTICLE_BLOCK_IMAGE_SINGLE_TITLE", "Image"),
    ],
    "blockHasImage" => ["image_text", "single_image"],
    "blockHasDescription" => ["text", "image_text"],
    "blockTypeTemplates" => [
        "text" => "ap::admin.article-blocks.templates.text",
        "image_text" => "ap::admin.article-blocks.templates.image-text",
        "gallery" => "ap::admin.article-blocks.templates.gallery",
        "single_image" => "ap::admin.article-blocks.templates.single-image",
    ],

    // Templates
    "templates" => [
        "image-text-block" => \GIS\ArticlePages\Templates\ImageTextBlock::class,
        "image-text-block-small" => \GIS\ArticlePages\Templates\ImageTextBlockSmall::class,
        "gallery-block" => \GIS\ArticlePages\Templates\GalleryBlock::class,
        "article-teaser" => \GIS\ArticlePages\Templates\ArticleTeaser::class,
        "mobile-article-teaser" => \GIS\ArticlePages\Templates\MobileArticleTeaser::class,
        "single-image-block" => \GIS\ArticlePages\Templates\SingleImageBlock::class,
    ],

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
