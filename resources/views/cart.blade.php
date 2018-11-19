@extends('layouts.index')
@section('content')
    <h2>Košík</h2>
        @foreach($cartItems as $item)
            <div class="form-group row">
                <img src="{{ asset("img/products/$item[product]->id") }}.jpg" alt="produkt {{ $item['product']->id }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-4 col-form-label">{{ $item['product']->name }}</label>
                <span class="col-1 col-form-label">{{ $item['product']->price }}€</span>
                <span class="col-1 d-none d-lg-flex">{{ $item['product']->code }}</span>
                <input type="number" class="form-control col-1" id="pocet1" value="{{ $item['number'] }}">
                <form action="{{ url("cart_item") . "/" . $item['product']->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="close col-1" aria-label="Close" value="&times;">
                        {{--<span aria-hidden="true">&times;</span>--}}
                </form>
                <span class="col-1 col-form-label">{{ $item['number'] * $item['product']->price }}€</span>
            </div>
        @endforeach
        <div class="form-group float-right">
            <button type="submit" class="btn btn-dark">Vybrať dopravu</button>
        </div>
@endsection
