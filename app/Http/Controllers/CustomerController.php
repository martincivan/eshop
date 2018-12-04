<?php

namespace App\Http\Controllers;

use App\Material;
use App\Product;
use Illuminate\Http\Request;


class CustomerController extends Controller {

    public function index() {
        $products = Product::all()->take(9);

        return view('home', ['products' => $products]);
    }

    public function category(Request $request, $id) {
        $products = Product::all()->where('category_id', '=', $id);
        $size = '*';
        if ($request->exists('size') && $request->get('size') != '*') {
            $size = $request->get('size');
            $products = $products->where('size', '=', $size);
        }
        $material = '*';
        if ($request->exists('material') && $request->get('material') != '*') {
            $material = $request->get('material');
            $products = $products->where('material_id', '=', $material);
        }

        $materials = Material::all();
        return view('category', ['products' => $products, 'materials' => $materials, 'filter_material' => $material, 'filter_size' => $size]);
    }

    public function product($id) {
        $product = Product::find($id);
        return view('product', ['product' => $product]);
    }

}
