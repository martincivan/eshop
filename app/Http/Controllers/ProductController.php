<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        response()->json(['success' => 'success'], 200);
    }

    public function create(Request $data)
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->code = $data['code'];
        $product->price = $data['price'];
        $product->size = $data['size'];
        $product->material_id = $data['material_id'];
        $product->category_id = $data['category_id'];
        $product->save();
        if ($data->hasFile('image')) {
            $data->file('image')->storeAs('img/products', $product->id . '.jpg',['disk' => 'public']);;
        }
        response()->json(['success' => 'success'], 200);
    }

    public function update(Request $data, $id)
    {
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->code = $data['code'];
        $product->price = $data['price'];
        $product->size = $data['size'];
        $product->material_id = $data['material_id'];
        $product->category_id = $data['category_id'];
        $product->save();
        if ($data->hasFile('image')) {
            $data->file('image')->storeAs('img/products', $product->id . '.jpg',['disk' => 'public']);;
        }
        response()->json(['success' => 'success'], 200);
    }

    public function list($page)
    {
        $rowsPerPage = request('rowsPerPage', 5);
        $sortBy = request('sortBy', 'name');
        $descendingBool = request('descending', 'false');
        $descending = $descendingBool === 'true' ? 'desc' : 'asc';
        if ($rowsPerPage == 0) {
            $products = DB::table('products')
                ->orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;
            $products = DB::table('products')
                ->orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->get();
        }
        $rowsNumber = DB::table('products')->count();

        return response()->json(['rows' => $products, 'rowsNumber' => $rowsNumber]);
    }

    public function show($id)
    {
        return Product::find($id)->toJson();
    }
}
