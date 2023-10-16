<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        return Brand::all();
    }
 
    public function show(Brand $brand)
    {
        return $brand;
    }
 
    public function store(Request $request)
    {
       try {
        $brand = Brand::create([
            'brandName' => $request->brandName,
            'description' => $request->description
        ]);
        return response()->json("Brand has been successfully Inserted: " . $brand, 201);
       }
       catch (err) {
        return response()->json($err);
       }
        
    }
 
    public function update(Request $request, Brand $brand)
    {
        //$product->update($request->all());
        $brand->update([
            'brandName' => $request->brandName,
            'description' => $request->description
        ]);
 
        return response()->json("Brand has been successfully updated: " . $brand, 200);
    }
 
    public function delete(Brand $brand)
    {

        try {
            $id = $brand->id;
            $brand->delete();
            return response()->json("Your " . $brand->name . " has been deleted", 200);
            }
            catch(err) {
                return response()->json($err);
            }
    }
}
