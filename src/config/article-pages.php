<?php

return [
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
        "gallery-block" => \GIS\ArticlePages\Templates\ImageTextBlock::class,
    ],

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
