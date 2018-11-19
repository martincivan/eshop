<?php

namespace App\Http\Controllers;

use App\Material;
use App\Product;

class CustomerController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('role:CUSTOMER');
    }

    public function index() {
        $products = Product::all()->take(9);

        return view('home', ['products' => $products]);
    }

    public function category($id) {
        $products = Product::all()->where('category_id', '=', $id);
        $materials = Material::all();
        return view('category', ['products' => $products, 'materials' => $materials]);
    }

    public function product($id) {
        $product = Product::find($id);
        return view('product', ['product' => $product]);
    }

}
