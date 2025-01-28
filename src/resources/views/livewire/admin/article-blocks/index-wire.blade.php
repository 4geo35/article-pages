<div class="row">
    <div class="col w-full space-y-indent-half">
        <div class="card">
            <div class="card-header">
                <div class="space-y-indent-half">
                    <h2 class="font-medium text-2xl">{{ __("Add block") }}</h2>
                    <x-tt::notifications.error prefix="block-" />
                    <x-tt::notifications.success prefix="block-" />
                </div>
            </div>

            <div class="card-body">
                @include("ap::admin.article-blocks.includes.buttons")
            </div>
        </div>

        @include("ap::admin.article-blocks.includes.items")
        @include("ap::admin.article-blocks.includes.modals")
    </div>
</div>
