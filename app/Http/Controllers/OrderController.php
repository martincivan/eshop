<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('role:CUSTOMER');
    }

    public function shipping() {
        $shippings = Shipping::all();

        return view('shipping', ['shippings' => $shippings]);
    }

    public function payment(Request $request) {
        $payments = Payment::all();
        $order = new Order();
        $order->shipping_id = $request['shipping_id'];
        $order->name = $request['name'];
        $order->street = $request['street'];
        $order->city = $request['city'];
        $order->bussiness_id = $request['bussiness_id'];
        $order->zip = $request['zip'];
        $order->user_id = Auth::user()->id;
        $request->session()->put('order', $order);


        return view('payment', ['payments' => $payments]);
    }

    public function create(Request $request) {
        $products = Product::all()->take(9);

        if (!$request->session()->exists('order')) {
            return view('home', ['products' => $products]);
        }

        $order = $request->session()->get('order');
        $order->payment_id = $request['payment_id'];
        $order->save();
        $cart = $request->session()->get('cart');

        foreach ($cart as $productId => $number) {
            $order->products()->attach($productId, ['number' => $number]);
        }
        $request->session()->remove('cart');
        $request->session()->remove('order');
        return view('home', ['products' => $products, 'notice' => 'Order successfully created']);
    }
}
