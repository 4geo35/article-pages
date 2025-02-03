@props(["article"])
@php($url = route('web.articles.show', ['article' => $article]))
<div class="h-full rounded flex flex-col overflow-hidden bg-white">
    <div class="relative">
        @if ($article->fixed_at)
            <div class="w-[30px] h-[30px] absolute top-0 right-0 mt-indent-xs mr-indent-xs text-white flex justify-center items-center">
                P
            </div>
        @endif
        <a href="{{ $url }}" class="block">
            @if($article->image)
                <picture>
                    <img src="{{ route('thumb-img', ['template' => 'article-teaser', 'filename' => $article->image->file_name]) }}" alt="">
                </picture>
            @else
                Empty
            @endif
        </a>
    </div>
    <div class="flex-1 flex flex-col justify-between py-indent px-indent-sm">
        <a href="{{ $url }}" class="text-xl font-semibold inline-block hover:text-primary-hover leading-tight">
            {{ $article->title }}
        </a>
        <div class="text-secondary mt-indent-half">
            {{ $article->published_date }}
        </div>
    </div>
</div>
