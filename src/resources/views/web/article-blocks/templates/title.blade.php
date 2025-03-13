@props(["block"])
@if ($block->title)
    <x-tt::h3 class="mb-indent-half">{{ $block->title }}</x-tt::h3>
@endif
