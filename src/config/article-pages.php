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

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
