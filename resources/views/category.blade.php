@extends('layouts.index')
@section('filter')
    <div id="filter" class="bg-secondary">
        <form class="form-inline">
            <label for="filter-material" class="col-sm-2 control-label text-light d-none d-sm-flex"> Material: </label>
            <div class="col">
                <select class="form-control" name="material" id="filter-material" onchange="this.form.submit()">
                    <option value="*"
                    @if('*' == $filter_material)
                    selected
                        @endif
                    >Nezáleží</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}" @if($material->id == $filter_material)
                        selected
                            @endif
                        >{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="filter-velkost" class="col-sm-2 control-label text-light  d-none d-sm-flex"> Velkost: </label>
            <div class="col">
                <select class="form-control" name="size" id="filter-velkost" onchange="this.form.submit()">
                    <option value="*"
                            @if('*' == $filter_size)
                            selected
                        @endif
                    >Nezáleží</option>
                    @for($i = 60; $i<=120; $i+=20)
                        <option value="{{ $i }}"
                                @if($i == $filter_size)
                                selected
                            @endif
                        >{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </form>
    </div>
@endsection
@section('content')
    @component('components.products', ['products' => $products])
    @endcomponent
@endsection
