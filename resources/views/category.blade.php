@extends('layouts.index')
@section('filter')
    <div id="filter" class="bg-secondary">
        <form class="form-inline">
            <label for="filter-material" class="col-sm-2 control-label text-light d-none d-sm-flex"> Material: </label>
            <div class="col">
                <select class="form-control" name="material" id="filter-material">
                    @foreach($materials as $material)
                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="filter-velkost" class="col-sm-2 control-label text-light  d-none d-sm-flex"> Velkost: </label>
            <div class="col">
                <select class="form-control" name="material" id="filter-velkost">
                    <option value="60">60</option>
                    <option value="80">80</option>
                    <option value="100">100</option>
                    <option value="120">120</option>
                </select>
            </div>
        </form>
    </div>
@endsection
@section('content')
    @component('components.products', ['products' => $products])
    @endcomponent
@endsection
