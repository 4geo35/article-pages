<x-admin-layout>
    <x-slot name="title">{{ __("Viewing an article") }}</x-slot>
    <x-slot name="pageTitle">{{ __("Viewing an article") }}</x-slot>

    <div class="flex flex-col gap-indent-half">
        <livewire:ap-article-show :article="$article" />
        <livewire:ap-article-block-index :article="$article" />
        <livewire:ma-metas :model="$article" />
    </div>
</x-admin-layout>
