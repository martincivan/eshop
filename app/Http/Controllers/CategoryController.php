<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list() {
        $result = [];
        foreach (Category::all() as $row) {
            $result[$row->id] = $row;
        }
        return response()->json($result);
    }
}
