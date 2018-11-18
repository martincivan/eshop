<div id="produkty" class="row">
    @foreach ($products as $product)
        @component('components.product_item', ['product' => $product])
        @endcomponent
    @endforeach
</div>
