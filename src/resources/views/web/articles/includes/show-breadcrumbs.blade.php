@if (config("article-pages.useBreadcrumbs"))
    @php($homeUrl = \Illuminate\Support\Facades\Route::has("web.home") ? route("web.home") : "/")
    <x-tt::breadcrumbs>
        <x-tt::breadcrumbs.item :url="$homeUrl">Главная</x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item :url="route('web.articles.index')">
            {{ config("article-pages.pageTitle") }}
        </x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item>{{ $article->title }}</x-tt::breadcrumbs.item>
    </x-tt::breadcrumbs>
@endif
