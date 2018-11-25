<?php

namespace App\Http\Controllers;

use App\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function shipping() {
        $shippings = Shipping::all();

        return view('shipping', ['shippings' => $shippings]);
    }
}
