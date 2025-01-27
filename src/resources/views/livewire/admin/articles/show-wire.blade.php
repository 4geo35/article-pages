<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-header">
                <div class="space-y-indent-half">
                    @include("ap::admin.articles.includes.show-title")
                    <x-tt::notifications.error />
                    <x-tt::notifications.success />
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col w-full sm:w-1/2 md:w-1/3 mb-indent-half">
                        <h3 class="font-semibold">{{ __("Cover") }}</h3>
                        <div>
                            @if ($article->image_id)
                                <a href="{{ $article->image->storage }}"
                                   class="text-info hover:text-info-hover"
                                   target="_blank">
                                    {{ __("Show") }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="col w-full sm:w-1/2 md:w-1/3 mb-indent-half">
                        <h3 class="font-semibold">{{ __("Created at") }}</h3>
                        <div>{{ $article->created_human }}</div>
                    </div>

                    <div class="col w-full sm:w-1/2 md:w-1/3 mb-indent-half">
                        <h3 class="font-semibold">{{ __("Published at") }}</h3>
                        <div>{{ $article->published_human ?? "-" }}</div>
                    </div>

                    <div class="col w-full sm:w-1/2 md:w-1/3 mb-indent-half">
                        <h3 class="font-semibold">{{ __("Slug") }}</h3>
                        <div>{{ $article->slug ?? "-" }}</div>
                    </div>

                    <div class="col w-full sm:w-1/2 md:w-2/3 mb-indent-half">
                        <h3 class="font-semibold">{{ __("Short description") }}</h3>
                        <div>{{ $article->short ?? "-" }}</div>
                    </div>
                </div>
            </div>
        </div>

        @include("ap::admin.articles.includes.table-modals")
    </div>
</div>
