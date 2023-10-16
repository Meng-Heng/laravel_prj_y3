<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use File;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brand.index')->with('brand', $brands);
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
    		$brands[$brand->id] = $brand->name;
    	}
    	return view('brand.create')->with('brand', $brand);
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
            'brandName' => 'required',
            'description' => 'required',
        ]);
          
        if ($validator->fails()) {
            return redirect('brand')->json([
                'error' => true,
                'msg' => $validator->errors()
            ]);
    }
    // Create brand

    $brand = new Brand();
    $brand->brandName = $request->brandName;
    $brand->description = $request->description;
    $brand->save();
    Session::flash('brand_create',' "' . $brand->brandName. '" has been inserted successfully!');
    return redirect('brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('brand.edit')->with('brand', $brand);
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
            'brandName' => 'required',
            'description' => 'required'
		]);
		if ($validator->fails()) {
			return redirect('brand')->json([
                'error' => true,
                'msg' => $validator->errors()
            ]);
        }
		// Create The Brand
		$brand = Brand::find($id);
		$brand->brandName = $request->Input('brandName');
        $brand->description = $request->Input('description');
		$brand->save();
		Session::flash('brand_update', ' "'. $brand->brandName . '" has been updated');
		return redirect('brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        Session::flash('brand_deleted','Brand "'. $brand->brandName . '" was deleted.');
        return redirect('brand');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $brands = Brand::where('brandName', 'like', "%$query%")
        ->get();

        return view('brand.search', compact('brands'));
    }

    public function getBySearch(Request $request)
    {
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "";
        $brand = Brand::all();
        if ($keyword != "") {
            return view('brand.search')
            ->with('brands', UserMgt::where('brandName', 'LIKE', '%' . $keyword . '%')->paginate(2))
                ->with('keyword', $keyword)
                ->with('brands', $brands);
        } else {
            return view('brand.index');
        }
    }
}
