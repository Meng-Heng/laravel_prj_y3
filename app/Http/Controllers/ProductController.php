<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Brand;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Session;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('product', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = array();
    	foreach (Brand::all() as $brand) {
    		$brands[$brand->id] = $brand->brandName;
    	}
    	return view('product.create')->with('brands', $brands); 
                                            // table, $variable
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'material' => 'required',
            'color' => 'required',
            'brand_id' => 'required|integer',
            'price' => 'required|max:20|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
          
        if ($validator->fails()) {
            return redirect('product/create')
            ->withInput()
            ->withErrors($validator);
        }
    
        // Create The product
        $image = $request->file('image');
        $upload = 'img/';
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename);
    
        $product = new Product();
        $product->name = $request->name;
        $product->material = $request->material;
        $product->color = $request->color;
	    $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->image = $filename;
        $product->save();
        Session::flash('product_create',' "'. $product->name . '" is created.');
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = array();
        foreach (Brand::all() as $brand) {
            $brands[$brand->id] = $brand->brandName;
        }
        $products = Product::findOrFail($id);
        return view('product.edit')->with('products', $products)->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
            'material' => 'required',
            'color' => 'required',
			'price' => 'required|max:20|min:3',
            'brand_id' => 'required|integer',
			'image' => 'mimes:jpg,jpeg,png,gif',
		]);

		if ($validator->fails()) {
			return redirect('product/')
				->withInput()
				->withErrors($validator);
		}
        $product = Product::find($id);
		// Create The Post
		if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/';
            $filename = time().$image->getClientOriginalName();
            move_uploaded_file($image->getPathName(), $upload . $filename);
		} 
		
		$product->name = $request->Input('name');
        $product->material = $request->Input('material');
        $product->color = $request->Input('color');
		$product->price = $request->Input('price');
        $product->brand_id = $request->Input('brand_id');
		if(isset($filename)){
		    $product->image = $filename;
		}
		$product->save();

		Session::flash('product_update',' "' . $product->name . '" is updated');
		return redirect('product/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
    	$image_path = 'img/'.$product->image;
    	File::delete($image_path);
    	$product->delete();
    	Session::flash('product_delete','Data is deleted.');
    	return redirect('product');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
        ->orWhere('material', 'like', "%$query%")
        ->orWhere('color', 'like', "%$query%")
        ->get();

        return view('product.search', compact('products'));
    }

    public function getBySearch(Request $request)
    {
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "";
        $product = Product::all();
        if ($keyword != "") {
            return view('product.search')
            ->with('products', Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(2))
                ->with('keyword', $keyword)
                ->with('products', $product);
        } else {
            return view('product.index');
        }
    }
}
