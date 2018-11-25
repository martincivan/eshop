@extends('layouts.index')
@section('content')
    <div class="container">
        <h2>Doprava</h2>
        <form action="{{ url("payment") }}" method="post">
        @foreach($shippings as $item)
            <div class="row">
                <img src="{{ asset("img/shippings/" . $item->id) }}.jpg" alt="doprava {{ $item->id }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-3 col-form-label">{{ $item->name }}</label>
                <span class="col-1 col-form-label">{{ $item->price }}€</span>
                <input type="radio" name="shipping_id" class="col-1" value="{{ $item->id }}">
            </div>
        @endforeach
        <div class="float-right">
            <button type="submit" class="btn btn-dark">Vybrať dopravu</button>
        </div>
        </form>
    </div>
@endsection
