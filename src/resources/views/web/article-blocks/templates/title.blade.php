@props(["block"])
@if ($block->title)
    <h2 class="font-medium text-xl mb-indent-half">{{ $block->title }}</h2>
@endif
