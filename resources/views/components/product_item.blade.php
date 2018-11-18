<div class="produkt col-md-4">
    <div class="card mb-4 shadow-sm">
        <img alt="Obrazok produktu {{$product->id}}" src="{{ asset("img/products/$product->id.jpg") }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><a href="{{ url('product') . '/' . $product->id }}">{{ $product->name }}</a></h5>
            <p class="card-text">Cena: {{ $product->price }}€</p>
        </div>
    </div>
</div>
