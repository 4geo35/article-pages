@props(["article"])
@php($url = route('web.articles.show', ['article' => $article]))
@php($disableImage = config("article-pages.disableCoverImage"))
@php($hasLabels = (bool) config("article-labels"))
<div class="h-full rounded-base flex flex-col overflow-hidden bg-white shadow-lg">
    @if (!$disableImage)
        <div class="relative">
            @if ($article->fixed_at)
                <div class="w-[35px] h-[35px] absolute top-0 right-0 mt-indent-xs mr-indent-xs text-white flex justify-center items-center rounded-full bg-black/15">
                    <x-ap::ico.pin />
                </div>
            @endif
            @if (config("article-labels"))
                <div class="absolute top-0 left-0 mt-indent space-y-indent-half">
                    @foreach($article->labels as $label)
                        <div class="px-indent-sm bg-[#545454] text-white text-sm sm:text-base rounded-e-full">{{ $label->title }}</div>
                    @endforeach
                </div>
            @endif
            <a href="{{ $url }}" class="block xs:h-[258px] sm:h-[194px] md:h-[254px] lg:h-[224px] xl:h-[208px] 2xl:h-[257px]">
                @if($article->image)
                    <picture>
                        <source media="(min-width: 640px)" srcset="{{ route('thumb-img', ['template' => 'article-teaser', 'filename' => $article->image->file_name]) }}">
                        <img
                            class="h-full object-cover object-center"
                            src="{{ route('thumb-img', ['template' => 'mobile-article-teaser', 'filename' => $article->image->file_name]) }}"
                            alt="">
                    </picture>
                @else
                    <div class="flex items-center justify-center h-full">
                        <x-fa::ico.image class="w-auto h-full min-h-[150px] text-secondary" />
                    </div>
                @endif
            </a>
        </div>
    @endif
    <div class="flex-1 flex flex-col justify-between py-indent px-indent-sm">
        <a href="{{ $url }}" class="text-lg leading-tight xs:text-xl xs:leading-tight font-semibold inline-block hover:text-primary-hover">
            {{ $article->title }}
        </a>
        @if ($disableImage)
            <div class="mt-indent-half">
                @if ($hasLabels)
                    <div class="flex flex-wrap">
                        @foreach($article->labels as $label)
                            <div class="px-indent-sm bg-[#545454] text-white text-sm sm:text-base rounded-full mr-indent-xs mb-indent-xs">{{ $label->title }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="flex items-center justify-between space-x-indent">
                    <div class="text-sm xs:text-base text-body/60">
                        {{ $article->published_date }}
                    </div>
                    @if ($article->fixed_at)
                        <div class="w-[20px] h-[20px] text-body/60 flex justify-center items-center rounded-full">
                            <x-ap::ico.pin />
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-sm xs:text-base text-body/60 mt-indent-half">
                {{ $article->published_date }}
            </div>
        @endif
    </div>
</div>
