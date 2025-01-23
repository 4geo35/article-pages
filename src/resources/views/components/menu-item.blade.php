@can("viewAny", config("article-pages.customArticleModel") ?? \GIS\ArticlePages\Models\Article::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.articles.index') }}"
        :active="in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.articles.index', 'admin.articles.show'])">
        <x-slot name="ico"><x-ap::ico.articles /></x-slot>
        {{ __("Articles") }}
    </x-tt::admin-menu.item>
@endcan
