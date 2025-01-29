@foreach($blocks as $block)
    @include("ap::web.article-blocks.templates.title")
    @includeIf(config("article-pages.webBlockTypeTemplates")[$block->type] ?? "ap::web.article-blocks.templates.empty")
@endforeach
