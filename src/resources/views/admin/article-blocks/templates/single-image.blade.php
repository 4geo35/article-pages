<div class="card-body">
    <div>
        <a href="{{ route("thumb-img", ["template" => "original", "filename" => $item->image->file_name]) }}"
           target="_blank" class="block mr-indent mb-indent basis-auto shrink-0">
            <picture>
                <source media="(min-width: 1280px)" srcset="{{ route('thumb-img', ['template' => 'image-text-block', 'filename' => $item->image->file_name]) }}">
                <img src="{{ route('thumb-img', ['template' => 'image-text-block-small', 'filename' => $item->image->file_name]) }}" alt="" class="mb-indent-half">
            </picture>
        </a>
    </div>

    <div class="text-info font-medium mt-indent-half text-xs">
        Поскольку размеры сайта и панели управления отличаются, здесь показано, как будет обрезано изображение.
    </div>
</div>
