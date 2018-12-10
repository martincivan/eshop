@extends('layouts.index')
@section('content')
    <div class="container">
        <h2>Platba</h2>
        <form action="{{ url("order") }}" method="post">
            {{ csrf_field() }}
        @foreach($payments as $item)
            <div class="row">
                <img src="{{ asset("img/payments/" . $item->id) }}.jpg" alt="platba {{ $item->name }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-3 col-form-label">{{ $item->name }}</label>
                <span class="col-1 col-form-label">{{ $item->price }}€</span>
                <input type="radio" name="payment_id" class="col-1" value="{{ $item->id }}" required>
            </div>
        @endforeach
        <div class="float-right">
            <button type="submit" class="btn btn-dark">Objednať</button>
        </div>
        </form>
    </div>
@endsection
