<div class="flex flex-col lg:flex-row space-y-indent-half lg:space-y-0 lg:space-x-indent-half">
    @foreach(config("article-pages.blockTypesList") as $key => $title)
        <button type="button" class="btn btn-outline-primary"
                @can("update", $article) wire:loding.attr="disabled"
                @else disabled
                @endcan
                wire:click="showCreateBlock('{{ $key }}')">
            {{ __($title) }}
        </button>
    @endforeach
</div>
