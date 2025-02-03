<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">{{ __("Delete article") }}</x-slot>
    <x-slot name="text">{{ __("It will be impossible to restore the article!") }}</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayPublish">
    <x-slot name="title">
        {{ __("Publish article") }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="setPublish" class="space-y-indent-half" id="articlePublishForm">
            <div>
                <label for="articlePublish" class="inline-block mb-2">
                    {{ __("Date of publish") }} <span class="text-danger">*</span>
                </label>
                <input type="datetime-local" id="articlePublish"
                       class="form-control {{ $errors->has("publishedAt") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="publishedAt">
                <x-tt::form.error name="publishedAt"/>
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closePublish">
                    {{ __("Cancel") }}
                </button>
                <button type="submit" form="articlePublishForm" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ __("Publish") }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>

<x-tt::modal.aside wire:model="displayData">
    <x-slot name="title">
        {{ $articleId ? __("Edit article") : __("Add article") }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $articleId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="articleDataForm">
            <div>
                <label for="articleTitle" class="inline-block mb-2">
                    {{ __("Title") }} <span class="text-danger">*</span>
                </label>
                <input type="text" id="articleTitle"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="articleSlug" class="inline-block mb-2">
                    {{ __("Slug") }}
                </label>
                <input type="text" id="articleSlug"
                       class="form-control {{ $errors->has("slug") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="slug">
                <x-tt::form.error name="slug"/>
            </div>

            <div>
                <label for="articleCover" class="inline-block mb-2">{{ __("Cover") }}</label>
                <input type="file" id="articleCover"
                       class="form-control {{ $errors->has('cover') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="cover">
                <x-tt::form.error name="cover" />
                @if ($coverUrl)
                    <div class="mt-indent-half">
                        <a href="{{ $coverUrl }}" target="_blank" class="text-primary hover:text-primary-hover">
                            {{ __("Picture") }}
                        </a>
                    </div>
                @endif
            </div>

{{--            <div>--}}
{{--                <label for="articleShort" class="inline-block mb-2">--}}
{{--                    {{ __("Short description") }}--}}
{{--                </label>--}}
{{--                <input type="text" id="articleShort"--}}
{{--                       class="form-control {{ $errors->has("short") ? "border-danger" : "" }}"--}}
{{--                       wire:loading.attr="disabled"--}}
{{--                       wire:model="short">--}}
{{--                <x-tt::form.error name="short"/>--}}
{{--            </div>--}}

            @if ($labelList)
                <div>
                    <div class="inline-block mb-2">Метки</div>
                    <div class="space-y-indent-half">
                        @foreach($labelList as $label)
                            <div class="form-check">
                                <input type="checkbox" wire:model="labels"
                                       class="form-check-input" id="label-{{ $label->id }}"
                                       value="{{ $label->id }}">
                                <label for="label-{{ $label->id }}" class="form-check-label">
                                    {{ $label->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    {{ __("Cancel") }}
                </button>
                <button type="submit" form="articleDataForm" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $articleId ? __("Update") : __("Add") }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
