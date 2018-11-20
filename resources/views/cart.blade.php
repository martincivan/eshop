@extends('layouts.index')
@section('content')
    <h2>Košík</h2>
        @foreach($cartItems as $item)
            <div class="row">
                <img src="{{ asset("img/products/$item[product]->id") }}.jpg" alt="produkt {{ $item['product']->id }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-4 col-form-label">{{ $item['product']->name }}</label>
                <span class="col-1 col-form-label">{{ $item['product']->price }}€</span>
                <span class="col-1 d-none d-lg-flex">{{ $item['product']->code }}</span>
                <form action="{{ url("cart_item") . "/" . $item['product']->id }}" class="col-1" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="number" name="number" class="form-control" id="pocet1" value="{{ $item['number'] }}" min="1" onchange="this.form.submit()">
                </form>
                <form action="{{ url("cart_item") . "/" . $item['product']->id }}" class="col-1" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="close" aria-label="Close" value="&times;">
                </form>
                <span class="col-1 col-form-label">{{ $item['number'] * $item['product']->price }}€</span>
            </div>
        @endforeach
        <div class="form-group float-right">
            <button type="submit" class="btn btn-dark">Vybrať dopravu</button>
        </div>
@endsection
