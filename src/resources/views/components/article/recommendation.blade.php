@props(["article"])
@php($url = route('web.articles.show', ['article' => $article]))
<div class="w-full rounded-base shadow-lg py-indent px-indent-lg">
    <a href="{{ $url }}" class="hover:text-primary-hover leading-tight text-xl font-semibold">
        {{ $article->title }}
    </a>
    <div class="text-body/60 mt-indent">
        {{ $article->published_date }}
    </div>
</div>
