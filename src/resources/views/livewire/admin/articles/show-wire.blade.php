<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-header">
                <div class="space-y-indent-half">
                    @include("ap::admin.articles.includes.show-title")
                    <x-tt::notifications.error />
                    <x-tt::notifications.success />
                </div>
            </div>
        </div>

        @include("ap::admin.articles.includes.table-modals")
    </div>
</div>
