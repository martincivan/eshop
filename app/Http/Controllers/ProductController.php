<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Arg;

class ProductController extends Controller
{
    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        response()->json(['success' => 'success'], 200);
    }

    public function create(Request $request) {
        $data = $request->json()->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->code = $data['code'];
        $product->price = $data['price'];
        $product->size = $data['size'];
        $product->material_id = $data['material_id'];
        $product->category_id = $data['category_id'];
        $product->save();
        response()->json(['success' => 'success'], 200);
    }

    public function update(Request $request, $id) {
        $data = $request->json()->all();
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->code = $data['code'];
        $product->price = $data['price'];
        $product->size = $data['size'];
        $product->material_id = $data['material_id'];
        $product->category_id = $data['category_id'];
        $product->save();
        response()->json(['success' => 'success'], 200);
    }

    public function list($page) {
        // get rowsPerPage from query parameters (after ?), if not set => 5
        $rowsPerPage = request('rowsPerPage', 5);

        // get sortBy from query parameters (after ?), if not set => name
        $sortBy = request('sortBy', 'name');

        // get descending from query parameters (after ?), if not set => false
        $descendingBool = request('descending', 'false');
        // convert descending true|false -> desc|asc
        $descending = $descendingBool === 'true' ? 'desc' : 'asc';

        // pagination
        // IFF rowsPerPage == 0, load ALL rows
        if ($rowsPerPage == 0) {
            // load all products from DB
            $products = DB::table('products')
                ->orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;

            // load products from DB
            $products = DB::table('products')
                ->orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->get();
        }

        // total number of rows -> for quasar data table pagination
        $rowsNumber = DB::table('products')->count();

        return response()->json(['rows' => $products, 'rowsNumber' => $rowsNumber]);
    }

    public function show($id) {
        return Product::find($id)->toJson();
    }
}
