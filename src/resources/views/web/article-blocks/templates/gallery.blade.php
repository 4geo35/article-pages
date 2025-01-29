@props(['block'])
<div class="row">
    @foreach($block->images as $image)
        <div class="col w-1/2 lg:w-1/3 mb-indent">
            <a data-fslightbox="lightbox-{{ $block->id }}" href="{{ route('thumb-img', ['template' => 'original', 'filename' => $image->file_name]) }}">
                <img src="{{ route('thumb-img', ['template' => 'gallery-block', 'filename' => $image->file_name]) }}" alt="">
            </a>
        </div>
    @endforeach
</div>
