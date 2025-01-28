@foreach($blocks as $item)
    <div class="card mx-indent overflow-visible" wire:key="{{ $item->id }}">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h2 class="font-medium text-xl">
                    @if ($item->title) {{ $item->title }} <span class="font-normal text-secondary">({{ $item->type_title }})</span>
                    @else {{ __("Block") }} {{ $item->type_title }}
                    @endif
                </h2>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-e-none"
                            @if ($loop->last) disabled
                            @else
                                @can("update", $article) wire:loding.attr="disabled"
                                @else disabled
                                @endcan
                            @endif
                            wire:click="moveDown({{ $item->id }})">
                        <x-tt::ico.line-arrow-bottom width="18" height="18" />
                    </button>
                    <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-none"
                            @if ($loop->first) disabled
                            @else
                                @can("update", $article) wire:loding.attr="disabled"
                                @else disabled
                                @endcan
                            @endif
                            wire:click="moveUp({{ $item->id }})">
                        <x-tt::ico.line-arrow-top width="18" height="18" />
                    </button>
                    <button type="button" class="btn btn-sm btn-dark px-btn-x-ico rounded-none"
                            @can("update", $article) wire:loding.attr="disabled"
                            @else disabled
                            @endcan
                            wire:click="showEdit({{ $item->id }})">
                        <x-tt::ico.edit />
                    </button>
                    <button type="button" class="btn btn-sm btn-danger px-btn-x-ico rounded-s-none"
                            @can("update", $article) wire:loding.attr="disabled"
                            @else disabled
                            @endcan
                            wire:click="showDelete({{ $item->id }})">
                        <x-tt::ico.trash />
                    </button>
                </div>
            </div>
        </div>
        @includeIf(config("article-pages.blockTypeTemplates")[$item->type] ?? "ap::admin.article-blocks.includes.empty")
    </div>
@endforeach
