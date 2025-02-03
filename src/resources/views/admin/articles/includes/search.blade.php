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

    <div class="flex flex-col md:flex-row space-y-indent-half md:space-y-0 md:space-x-indent-half ml-indent-half">
        @can("create", config("article-pages.customArticleModel") ?? \GIS\ArticlePages\Models\Article::class)
            <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showCreate">
                <x-tt::ico.circle-plus />
                <span class="hidden lg:inline-block pl-btn-ico-text">{{ __("Add") }}</span>
            </button>
        @endcan
        @includeIf("al::admin.article-labels.list-button")
    </div>
</div>
