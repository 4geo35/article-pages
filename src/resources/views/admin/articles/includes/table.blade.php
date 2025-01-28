<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading class="text-left text-nowrap">{{ __("Title") }}</x-tt::table.heading>
            <x-tt::table.heading class="text-left text-nowrap">{{ __("Slug") }}</x-tt::table.heading>
            <x-tt::table.heading class="text-left text-nowrap">{{ __("Shor description") }}</x-tt::table.heading>
            <x-tt::table.heading>{{ __("Actions") }}</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($articles as $item)
            <tr>
                <td class="text-nowrap">{{ $item->title }}</td>
                <td class="text-nowrap">{{ $item->slug }}</td>
                <td>{{ $item->short }}</td>
                <td>
                    <div class="flex justify-center">
                        @cannot("viewAny", $item::class)
                            <button type="button" disabled class="btn btn-primary px-btn-ico-text rounded-e-none">
                                <x-tt::ico.eye />
                            </button>
                        @else
                            <a href="{{ route('admin.articles.show', ['article' => $item]) }}"
                               class="btn btn-primary px-btn-ico-text rounded-e-none">
                                <x-tt::ico.eye />
                            </a>
                        @endcannot
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-none"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @cannot("delete", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash />
                        </button>

                        <button type="button" class="btn {{ $item->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half rounded-e-none"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="switchPublish({{ $item->id }})">
                            @if ($item->published_at)
                                <x-tt::ico.toggle-on />
                            @else
                                <x-tt::ico.toggle-off />
                            @endif
                        </button>
                        <button type="button" class="btn {{ $item->fixed_at ? 'btn-primary' : 'btn-outline-primary' }} px-btn-x-ico rounded-s-none"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="switchFixed({{ $item->id }})">
                            <x-ap::ico.pin />
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
    <x-slot name="caption">
        <div class="flex justify-between">
            <div>{{ __("Total") }}: {{ $articles->total() }}</div>
            {{ $articles->links("tt::pagination.live") }}
        </div>
    </x-slot>
</x-tt::table>
