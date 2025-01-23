<?php

return [
    // Admin
    // Articles
    "customArticleModel" => null,
    "customArticleIndexComponent" => null,

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
