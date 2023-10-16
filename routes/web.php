<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', [ProductController::class, 'index'])->name('product.index');


/* 
        User
*/
// Select
Route::get('/user', [UserController::class, 'index'])->name("user.index");
// Create
Route::get('/user/create', [UserController::class, 'create'])->name("user.create");
Route::post('/user', [UserController::class, 'store'])->name("user.store");
// Edit
Route::get("/user/{userId}/edit", [UserController::class, 'edit'])->name('user.edit');
Route::put("/user/{userId}", [UserController::class, 'update'])->name('user.update');
// Delete
Route::delete("/user/{userId}", [UserController::class, 'destroy'])->name('user.delete');
// Detail
Route::get('/user/{userId}', [UserController::class, 'show'])->name("user.show");
// Search
Route::get('/users', [UserController::class, 'search'])->name('users.search');
Route::get('/user/search', [UserController::class, 'search'])->name("user.search");
Route::get('/user/{searchById}', [UserController::class, 'search'])->name("user.searchId");
// Filter
// Route::post('user', 'UserController@status_filter');

/* 
        Brand
*/
// Select
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
// Create
Route::get('/brand/create', [BrandController::class, 'create'])->name("brand.create");
Route::post('/brand', [BrandController::class, 'store'])->name("brand.store");
// Edit
Route::get("/brand/{brandId}/edit", [BrandController::class, 'edit'])->name('brand.edit');
Route::put("/brand/{brandId}", [BrandController::class, 'update'])->name('brand.update');
// Delete
Route::delete("/brand/{brandId}", [BrandController::class, 'destroy'])->name('brand.delete');
// Detail
Route::get('/brand/{brandId}', [BrandController::class, 'show'])->name("brand.show");
// Search
Route::get('/brands', [BrandController::class, 'search'])->name('brands.search');
Route::get('/brand/search', [BrandController::class, 'search'])->name("brand.search");
Route::get('/brand/{searchById}', [BrandController::class, 'search'])->name("brand.searchId");


/* 
        Product
*/
// Select
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
// Create
Route::get('/product/create', [ProductController::class, 'create'])->name("product.create");
Route::post('/product', [ProductController::class, 'store'])->name("product.store");
// Edit
Route::get("/product/{productId}/edit", [ProductController::class, 'edit'])->name('product.edit');
Route::put("/product/{productId}", [ProductController::class, 'update'])->name('product.update');
// Delete
Route::delete("/product/{productId}", [ProductController::class, 'destroy'])->name('product.delete');
// Detail
Route::get('/product/{productId}', [ProductController::class, 'show'])->name("product.show");
// Search
Route::get('/products', [ProductController::class, 'search'])->name('products.search');
Route::get('/product/search', [ProductController::class, 'search'])->name("product.search");
Route::get('/product/{searchById}', [ProductController::class, 'search'])->name("product.searchId");


//frontend
Route::get('/',[FrontendController::class,'index']);
Route::get('/watch',[FrontendController::class,'list']);
Route::get('/contact',[FrontendController::class,'contact']);
Route::get('/cart',[FrontendController::class,'cart']);

Route::get('/detail',[FrontendController::class,'detail']);
Route::get('/checkout',[FrontendController::class,'checkout']);


//login-register
Route::get('/login', [FrontendController::class, 'login'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registration', [FrontendController::class, 'registration'])->name('register');
Route::post('/post-registration', [FrontendController::class, 'postRegistration'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Add to cart
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [StoreController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-cart', [StoreController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [StoreController::class, 'remove'])->name('remove.from.cart');

