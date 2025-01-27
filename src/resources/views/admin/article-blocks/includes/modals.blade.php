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
        <form id="blockDataForm" class="space-y-indent-half" wire:submit.prevent="{{ $blockId ? 'update' : 'store' }}">
            <div>
                <label for="title" class="inline-block mb-2">
                    Заголовок
                </label>
                <input type="text" id="title"
                       class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title" />
                <div class="mt-indent-half text-info">
                    Будет добавлен над блоком, если заполнить
                </div>
            </div>

            @if (in_array($type, config('article-pages.blockHasImage')))
                <div>
                    <label for="blockImage" class="inline-block mb-2">
                        {{ __("Image") }} <span class="text-danger">*</span>
                    </label>
                    <input type="file" id="cover" class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}"
                           wire:loading.attr="disabled"
                           wire:model.lazy="image">
                    <x-tt::form.error name="image" />
                    @if ($imageUrl)
                        <div class="mt-indent-half">
                            <a href="{{ $imageUrl }}" target="_blank" class="text-primary hover:text-primary-hover">{{ __("Image") }}</a>
                        </div>
                    @endif
                </div>
            @endif

            @if (in_array($type, config('article-pages.blockHasDescription')))
                <div>
                    <label for="productDescription" class="flex justify-start items-center mb-2">
                        Описание
                        @include("tt::admin.description-button", ["id" => "blockInfoHidden"])
                    </label>
                    @include("tt::admin.description-info", ["id" => "blockInfoHidden"])
                    <textarea id="productDescription" class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                              rows="10"
                              wire:model.live="description">
                        {{ $description }}
                    </textarea>
                    <x-tt::form.error name="description" />

                    <div class="prose prose-sm">
                        {!! \Illuminate\Support\Str::markdown($description) !!}
                    </div>
                </div>
            @endif

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    {{ __("Cancel") }}
                </button>
                <button type="submit" form="blockDataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $blockId ? __("Update") : __("Add") }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
