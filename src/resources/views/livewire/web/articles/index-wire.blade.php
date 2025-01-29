<div class="container">
    <div class="row">
        @foreach($articles as $item)
            <div class="col w-1/2 lg:w-1/3 xl:w-1/4 mb-indent-half">
                <x-ap::article.teaser :article="$item"/>
            </div>
        @endforeach
    </div>
    <div class="flex justify-end">
        {{ $articles->links("tt::pagination.web-live") }}
    </div>
</div>
