@props(["article"])
@php($url = route('web.articles.show', ['article' => $article]))
<div class="h-full rounded-base flex flex-col overflow-hidden bg-white shadow-lg">
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
        <a href="{{ $url }}" class="block">
            @if($article->image)
                <picture>
                    <source media="(min-width: 480px)" srcset="{{ route('thumb-img', ['template' => 'article-teaser', 'filename' => $article->image->file_name]) }}">
                    <img src="{{ route('thumb-img', ['template' => 'mobile-article-teaser', 'filename' => $article->image->file_name]) }}" alt="">
                </picture>
            @else
                <div class="flex items-center justify-center">
                    <x-fa::ico.image class="w-auto min-h-[150px] xs:h-[162px] sm:h-[193px] md:h-[252px] lg:h-[222px] xl:h-[207px] 2xl:h-[257px] text-secondary" />
                </div>
            @endif
        </a>
    </div>
    <div class="flex-1 flex flex-col justify-between py-indent px-indent-sm">
        <a href="{{ $url }}" class="text-lg leading-tight xs:text-xl xs:leading-tight font-semibold inline-block hover:text-primary-hover">
            {{ $article->title }}
        </a>
        <div class="text-sm xs:text-base text-secondary mt-indent-half">
            {{ $article->published_date }}
        </div>
    </div>
</div>
