<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }
 
    public function show(Product $product)
    {
        return $product;
    }
 
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'material' => $request->material,
            'color' => $request->color,
            'image' => $request->image,
            'price' => $request->price,
            'brand_id' => $request->brand_id
        ]);
        return response()->json($product, 201);
    }
 
    public function update(Request $request, Product $product)
    {
        //$product->update($request->all());
        $product->update([
            'name' => $request->name,
            'material' => $request->material,
            'color' => $request->color,
            'image' => $request->image,
            'price' => $request->price,
            'brand_id' => $request->brand_id
        ]);
 
        return response()->json("Product has been successfully updated: " . $product, 200);
    }
 
    public function delete(Product $product)
    {
        try {
        $id = $product->id;
        $product->delete();
        return response()->json("Your " . $product->name . " has been deleted", 200);
        }
        catch(err) {
            return response()->json($err);
        }
    }
}
