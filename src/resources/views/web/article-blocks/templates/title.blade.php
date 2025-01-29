@props(["block"])
@if ($block->title)
    <h4 class="font-medium text-xl mb-indent-half">{{ $block->title }}</h4>
@endif
