<x-app-layout>
    @include("ap::web.articles.includes.metas")
    @include("ap::web.articles.includes.show-breadcrumbs")
    @include("ap::web.articles.includes.show-h1")

    <div class="container">
        @if (config("article-labels") && $article->labels->count())
            <div class="flex flex-wrap mb-indent-half">
                @foreach($article->labels as $label)
                    <a href="{{ route("web.articles.index") }}?label[0]={{ $label->slug }}"
                       class="btn btn-sm btn-outline-secondary mr-indent-half mb-indent-half">
                        {{ $label->title }}
                    </a>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col w-full xl:w-3/4">
                @include("ap::web.articles.includes.blocks")
            </div>
            <div class="col w-full xl:w-1/4">
                @include("ap::web.articles.includes.recommendations")
            </div>
        </div>
    </div>
</x-app-layout>
