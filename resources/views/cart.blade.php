@extends('layouts.index')
@section('content')
    <div class="container-fluid bg-light">
    <h2>Košík</h2>
        @forelse($cartItems as $item)
            <div class="row bg-white border-bottom border-top">
                <img src="{{ asset("img/products/" . $item['product']->id) }}.jpg" alt="produkt {{ $item['product']->id }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-3 col-form-label my-auto">{{ $item['product']->name }}</label>
                <span class="col-1 col-form-label my-auto">{{ $item['product']->price }}€</span>
                <span class="col-1 col-form-label d-none d-lg-flex my-auto">{{ $item['product']->code }}</span>
                <form action="{{ url("cart_item") . "/" . $item['product']->id }}" class="col-2 my-auto" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="number" name="number" class="form-control my-auto" id="pocet1" value="{{ $item['number'] }}" min="1" onchange="this.form.submit()">
                </form>
                <form action="{{ url("cart_item") . "/" . $item['product']->id }}" class="my-auto" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn-danger rounded">&times;</button>
                </form>
                <span class="col-1 col-form-label">{{ $item['number'] * $item['product']->price }}€</span>
            </div>
        @empty

                <img src="{{ asset('img/Nullset.svg') }}" alt="empty cart" class="mx-auto d-block">
        @endforelse
    </div>
    @if(isset($cartItems) && is_array($cartItems) && count($cartItems) > 0)
    <div class="clearfix">
    </div>
        <div class="float-right">
            <a class="btn btn-outline-dark" href="{{ url('shipping') }}" role="button">Vybrať dopravu</a>
        </div>
    @endif
@endsection
