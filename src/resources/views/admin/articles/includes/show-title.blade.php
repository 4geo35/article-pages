<div class="flex justify-between items-center">
    <h2 class="font-medium text-2xl">{{ $article->title }}</h2>

    <div class="flex justify-end">
        <button type="button" class="btn btn-primary px-btn-x-ico rounded-e-none"
                @cannot("update", $article) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showEdit({{ $article->id }})">
            <x-tt::ico.edit />
        </button>
        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                @cannot("delete", $article) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showDelete({{ $article->id }})">
            <x-tt::ico.trash />
        </button>

        <button type="button" class="btn {{ $article->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half rounded-e-none"
                @cannot("update", $article) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="switchPublish({{ $article->id }})">
            @if ($article->published_at)
                <x-tt::ico.toggle-on />
            @else
                <x-tt::ico.toggle-off />
            @endif
        </button>
        <button type="button" class="btn {{ $article->fixed_at ? 'btn-primary' : 'btn-outline-primary' }} px-btn-x-ico rounded-s-none"
                @cannot("update", $article) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="switchFixed({{ $article->id }})">
            <x-ap::ico.pin />
        </button>
    </div>
</div>
