<div class="row">
    @foreach($more as $item)
        <div class="col w-full xs:w-1/2 xl:w-full mb-indent-half">
            <x-ap::article.recommendation :article="$item" />
        </div>
    @endforeach
</div>
