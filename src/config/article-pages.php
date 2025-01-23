<?php

return [
    // Admin
    // Articles
    "customArticleModel" => null,
    "customArticleAdminController" => null,
    "customArticleIndexComponent" => null,

    // Policy
    "articlePolicyTitle" => "Управление статьями",
    "articlePolicy" => \GIS\ArticlePages\Policies\ArticlePolicy::class,
    "articlePolicyKey" => "articles",
];
