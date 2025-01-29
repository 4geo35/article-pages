<x-app-layout>
    @include("ap::web.articles.includes.metas")
    @include("ap::web.articles.includes.show-breadcrumbs")
    @include("ap::web.articles.includes.show-h1")

    <div class="container">
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
