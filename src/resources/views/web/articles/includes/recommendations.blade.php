<div class="space-y-indent-half">
    @foreach($more as $item)
        <x-ap::article.recommendation :article="$item" />
    @endforeach
</div>
