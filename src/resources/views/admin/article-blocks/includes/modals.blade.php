<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">{{ __("Delete block") }}</x-slot>
    <x-slot name="text">{{ __("It will be impossible to restore the block!") }}</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $blockId ? __("Edit block") : __("Add block") }}
        "{{ empty(config("article-pages.blockTypesList")[$this->type]) ? "-" : __(config("article-pages.blockTypesList")[$this->type]) }}"
    </x-slot>
    <x-slot name="content">
        Hello
    </x-slot>
</x-tt::modal.dialog>
