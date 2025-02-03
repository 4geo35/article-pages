<div class="container">
    @if (config("article-labels") && $labels)
        <div class="flex flex-wrap mb-indent-half">
            @foreach($labels as $label)
                <button type="button"
                        class="btn btn-sm mr-indent-half mb-indent-half {{ in_array($label->slug, $searchLabel) ? 'btn-secondary' : 'btn-outline-secondary' }}"
                        wire:click="switchLabel('{{ $label->slug }}')">
                    {{ $label->title }}
                </button>
            @endforeach
        </div>
    @endif
    <div class="row">
        @foreach($articles as $item)
            <div class="col w-full xs:w-1/2 lg:w-1/3 xl:w-1/4 mb-indent">
                <x-ap::article.teaser :article="$item"/>
            </div>
        @endforeach
    </div>
    <div class="flex justify-end">
        {{ $articles->links("tt::pagination.web-live") }}
    </div>
</div>
