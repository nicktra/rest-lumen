<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
}
