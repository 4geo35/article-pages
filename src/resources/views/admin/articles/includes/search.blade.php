<div class="flex justify-between">
    <div class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
        <input type="text" aria-label="{{ __('Title') }}" placeholder="{{ __('Title') }}" class="form-control" wire:model.live="searchTitle">
        <select class="form-select" aria-label="Fixed state" wire:model.live="searchFixed">
            <option value="all">-- {{ __("Fixed state") }}</option>
            <option value="yes">{{ __("Fixed") }}</option>
            <option value="no">{{ __("Not fixed") }}</option>
        </select>
        <button type="button" class="btn btn-outline-primary" wire:click="clearSearch">
            {{ __("Clear") }}
        </button>
    </div>

    <div>
        @can("create", config("article-pages.customArticleModel") ?? \GIS\ArticlePages\Models\Article::class)
            <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x ml-indent-half" wire:click="showCreate">
                <x-tt::ico.circle-plus />
                <span class="hidden lg:inline-block pl-btn-ico-text">{{ __("Add") }}</span>
            </button>
        @endcan
    </div>
</div>
