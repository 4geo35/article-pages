<div class="card-body">
    <div class="row">
        <div class="col w-full md:w-1/3">
            <a href="{{ route("thumb-img", ["template" => "original", "filename" => $item->image->file_name]) }}"
               target="_blank" class="block mr-indent mb-indent basis-auto shrink-0">
                <picture>
                    <source media="(min-width: 1280px)" srcset="{{ route('thumb-img', ['template' => 'image-text-block', 'filename' => $item->image->file_name]) }}">
                    <img src="{{ route('thumb-img', ['template' => 'image-text-block-small', 'filename' => $item->image->file_name]) }}" alt="" class="mb-indent-half">
                </picture>
            </a>
        </div>
        <div class="col w-full md:w-2/3">
            <div class="prose max-w-none">{!! $item->markdown !!}</div>
        </div>
    </div>

    <div class="text-info font-medium mt-indent-half text-xs">
        Так как размер сайта и панели администрирования отличаются, здесь показано, как изображение соотносится с текстом и какой оно имеет размер. Также может отличаться стиль и шрифт текста.
    </div>
</div>
