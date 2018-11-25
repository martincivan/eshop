<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller {

    public function addItem(Request $request) {
        if ($request->session()->exists('cart')) {
            $session = $request->session()->get('cart');
        } else {
            $session = [];
        }
        if (isset($session[$request->get('id')])) {
            $session[$request->get('id')] += $request->get('number');
        } else {
            $session[$request->get('id')] = $request->get('number');
        }
        $request->session()->put('cart', $session);
        return back();
    }

    public function changeItemNumber(Request $request, $id) {
        if ($request->session()->exists('cart')) {
            $session = $request->session()->get('cart');
            $session[$id] = $request->get('number');
            $request->session()->put('cart', $session);
        }
        return back();
    }

    public function removeItem(Request $request, $id) {
        if ($request->session()->exists('cart')) {
            $session = $request->session()->get('cart');
            unset($session[$id]);
            $request->session()->put('cart', $session);
        }
        return back();
    }

    public function index() {
        $items = [];
        if (session()->exists('cart')) {
            $session = session()->get('cart');
            $products = Product::find(array_keys($session));
            foreach ($products as $product) {
                $row = [];
                $row['product'] = $product;
                $row['number'] = $session[$product->id];
                $items[] = $row;
            }
        }
        return view('cart', ['cartItems' => $items]);
    }
}
