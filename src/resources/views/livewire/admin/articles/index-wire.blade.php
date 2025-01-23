<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-body">
                <div class="space-y-indent-half">
                    @include("ap::admin.articles.includes.search")
                    <x-tt::notifications.error />
                    <x-tt::notifications.success />
                </div>
            </div>

            @include("ap::admin.articles.includes.table")
            @include("ap::admin.articles.includes.table-modals")
        </div>
    </div>
</div>
