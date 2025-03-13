@foreach($blocks as $block)
    @if (! in_array($block->type, config("article-pages.insideTitle")))
        @include("ap::web.article-blocks.templates.title")
    @endif
    @includeIf(config("article-pages.webBlockTypeTemplates")[$block->type] ?? "ap::web.article-blocks.templates.empty")
@endforeach
