@if (config("article-pages.useH1"))
    <div class="container">
        <x-tt::h1 class="mb-indent">{{ config("article-pages.pageTitle") }}</x-tt::h1>
    </div>
@endif
