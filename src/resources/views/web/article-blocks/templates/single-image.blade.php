@props(['block'])
<div class="row mb-indent">
    <div class="col w-full">
        <a data-fslightbox="lightbox-{{ $block->id }}" href="{{ route('thumb-img', ['template' => 'original', 'filename' => $block->image->file_name]) }}">
            <picture>
                <img src="{{ route('thumb-img', ['template' => 'single-image-block', 'filename' => $block->image->file_name]) }}" alt="" class="mb-indent-half rounded">
            </picture>
        </a>
    </div>
</div>
