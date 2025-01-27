<?php

return [
    // Admin
    // Articles
    "customArticleModel" => null,
    "customArticleAdminController" => null,
    "customArticleIndexComponent" => null,
    "customArticleShowComponent" => null,
    // Blocks
    "customArticleBlockModel" => null,
    "customArticleBlockIndexComponent" => null,
    "blockTypesList" => [
        "text" => "Text",
        "image_text" => "Text + Image",
        "gallery" => "Image gallery",
        "single_image" => "Image",
    ],
    "blockImageValidation" => ["image_text", "single_image"],
    "blockDescriptionValidation" => ["text", "image_text"],

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
