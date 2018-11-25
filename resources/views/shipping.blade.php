@extends('layouts.index')
@section('content')
    <div class="container">
        <h2>Doprava</h2>
        <form action="{{ url("payment") }}" method="post">
            {{ csrf_field() }}
        @foreach($shippings as $item)
            <div class="row">
                <img src="{{ asset("img/shippings/" . $item->id) }}.jpg" alt="doprava {{ $item->id }}"
                     class="col-2 miniatura">
                <label for="pocet1" class="col-3 col-form-label">{{ $item->name }}</label>
                <span class="col-1 col-form-label">{{ $item->price }}€</span>
                <input type="radio" name="shipping_id" class="col-1" value="{{ $item->id }}">
            </div>
        @endforeach
            <div class="form-group row">
                <label for="meno" class="col-sm-3 col-form-label d-none d-sm-flex">Meno / názov spoločnosti</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="meno" name="name" placeholder="Meno / názov spoločnosti" value="{{ Auth::user()->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="ico" class="col-sm-3 col-form-label d-none d-sm-flex">IČO</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ico" name="bussiness_id" placeholder="IČO" value="{{ Auth::user()->bussiness_id }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="ulica" class="col-sm-3 col-form-label d-none d-sm-flex">Ulica a popisné číslo</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ulica" name="street" placeholder="Ulica a číslo" value="{{ Auth::user()->street }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="mesto" class="col-sm-3 col-form-label d-none d-sm-flex">Mesto </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="mesto" name="city" placeholder="Mesto" value="{{ Auth::user()->city }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="psc" class="col-sm-3 col-form-label d-none d-sm-flex">PSČ</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="psc" name="zip" placeholder="PSČ" value="{{ Auth::user()->zip }}">
                </div>
            </div>
        <div class="float-right">
            <button type="submit" class="btn btn-dark">Vybrať dopravu</button>
        </div>
        </form>
    </div>
@endsection
