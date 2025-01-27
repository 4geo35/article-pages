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

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
