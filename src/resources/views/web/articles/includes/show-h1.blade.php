@if (config("article-pages.useH1"))
    <div class="container">
        <x-tt::h1 class="mb-indent">{{ $article->title }}</x-tt::h1>
    </div>
@endif
