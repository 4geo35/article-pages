@props(['block'])
<div class="row mb-indent">
    <div class="col w-full md:w-1/2 lg:w-1/3">
        <a data-fslightbox="lightbox-{{ $block->id }}" href="{{ route('thumb-img', ['template' => 'original', 'filename' => $block->image->file_name]) }}">
            <picture>
                <source media="(min-width: 1280px)" srcset="{{ route('thumb-img', ['template' => 'image-text-block', 'filename' => $block->image->file_name]) }}">
                <img src="{{ route('thumb-img', ['template' => 'image-text-block-small', 'filename' => $block->image->file_name]) }}" alt="" class="mb-indent-half rounded-base">
            </picture>
        </a>
    </div>
    <div class="col w-full md:w-1/2 lg:w-2/3">
        <div class="prose max-w-none">{!! $block->markdown !!}</div>
    </div>
</div>
