<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:CUSTOMER');
    }

    public function index() {
        return view('home');
    }
}
