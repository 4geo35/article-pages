@props(["article"])
@php($url = route('web.articles.show', ['article' => $article]))
<div>
    <a href="{{ $url }}" class="text-primary hover:text-primary-hover">
        {{ $article->title }}
    </a>
    <div class="text-xs text-secondary mt-2">
        {{ $article->published_human }}
    </div>
</div>
