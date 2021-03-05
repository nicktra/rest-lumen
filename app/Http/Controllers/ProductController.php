<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();

        return response()->json($product);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|integer',
            'color' => 'required|string',
            'condition' => 'required|in:new,old',
            'description' => 'string'
        ]);

        $data = $request->all();
        $product = Product::create($data);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        $this->validate($request, [
            'name' => 'string',
            'price' => 'integer',
            'color' => 'string',
            'condition' => 'in:new,old',
            'description' => 'string'
        ]);

        $data = $request->all();

        $product->fill($data);

        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product Deleted!']);
    }
}
