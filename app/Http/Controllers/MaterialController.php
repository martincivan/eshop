<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use stdClass;

class MaterialController extends Controller
{
    public function list() {
        $result = [];
        foreach (Material::all() as $row) {
            $result[$row->id] = $row;
        }
        return response()->json($result);
    }
}
