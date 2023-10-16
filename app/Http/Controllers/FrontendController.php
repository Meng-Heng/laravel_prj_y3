<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("frontend.index");
    }
    public function product()
    {
        return view("frontend.product");
    }
    public function contact()
    {
        return view("frontend.contact");
    }
    public function cart()
    {
        return view("frontend.cart");
    }
    public function detail()
    {
        return view("frontend.detail");
    }
    public function login()
    {
        return view("frontend.login");
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false;
        // config/session.php set 'expire_on_close' => true,
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/')->withSuccess("Log-in Successful");
        }
        return redirect("login")->withErrors('You have entered invalid credentials!');
    }


    public function checkout()
    {
        return view("frontend.checkout");
    }
    public function registration()
    {
        return view("frontend.registration");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function list()
    {
        $brands = Brand::all();
        $products = Product::orderBy('name','ASC')->paginate(15);
    	return view('frontend.product')->with('products',$products)->with('brands', $brands);
    }

    public function getBySearch(Request $request) {
        $keyword = !empty($request->input('keyword'))?$request->input('keyword'):"";
        $brands = Brand::all();
        if( $keyword != ""){
            return view('frontend.search')
                ->with('products', Product::where('name', 'LIKE', '%'.$keyword.'%')->paginate(4))
                ->with('keyword', $keyword)
                ->with('brands', $brands);
        } else {
            return view('frontend.search')
                ->with('products', Product::paginate(4))
                ->with('keyword', $keyword)
                ->with('brands', $brands);
        } 
    }
}
