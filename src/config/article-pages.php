<?php

return [
    // Web
    "pagePrefix" => "articles",
    "useBreadcrumbs" => true,
    "pageTitle" => "Статьи",
    "useH1" => true,
    "customArticleWebController" => null,
    "customArticleWebIndexComponent" => null,
    "webBlockTypeTemplates" => [
        "text" => "ap::web.article-blocks.templates.text",
        "image_text" => "ap::web.article-blocks.templates.image-text",
        "gallery" => "ap::web.article-blocks.templates.gallery",
        "single_image" => "ap::web.article-blocks.templates.single-image",
    ],
    "insideTitle" => [],

    // Admin
    // Articles
    "customArticleModel" => null,
    "customArticleModelObserver" => null,
    "customArticleAdminController" => null,
    "customArticleIndexComponent" => null,
    "customArticleShowComponent" => null,
    // Blocks
    "customArticleBlockModel" => null,
    "customArticleBlockModelObserver" => null,
    "customArticleBlockIndexComponent" => null,
    "blockTypesList" => [
        "text" => "Text",
        "image_text" => "Text + Image",
        "gallery" => "Image gallery",
        "single_image" => "Image",
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
