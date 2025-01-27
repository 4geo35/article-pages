<div class="flex flex-col lg:flex-row space-y-indent-half lg:space-y-0 lg:space-x-indent-half">
    @foreach(config("article-pages.blockTypesList") as $key => $title)
        <button type="button" class="btn btn-outline-primary"
                wire:click="showCreateBlock('{{ $key }}')" wire:loading.attr="disabled">
            {{ __($title) }}
        </button>
    @endforeach
</div>
