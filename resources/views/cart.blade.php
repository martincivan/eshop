@extends('layouts.index')
@section('content')
    <div id="produkt" class="container">
        <h2>{{ $product->name }}</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset("img/products/$product->id.jpg") }}" alt="Obrazok produktu {{$product->id}}">
                <p>Cena: {{ $product->price }}€</p>
                <form class="form-inline">
                    <label for="pocet" class="d-none d-sm-flex"> Pocet: </label>
                    <input type="number" name="pocet" id="pocet" value="1">
                    <input type="submit" class="btn-dark" value="Kupit">
                </form>
            </div>
            <div class="col-md-6">
                <p>{{ $product->description }}</p>
                <table class="table">
                    <tr>
                        <td>Material:</td>
                        <td>{{ $product->material->name }}</td>
                    </tr>
                    <tr>
                        <td>Velkost:</td>
                        <td>{{ $product->size }}</td>
                    </tr>
                    <tr>
                        <td>Kod tovaru:</td>
                        <td>{{ $product->code }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
