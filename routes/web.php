<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\FrontendController as FrontendUserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ------------------------------Front End------------------------------------------------
Route::get('load-cart',[CartController::class,'cartcount']);
Route::get('load-wish',[WishlistController::class,'wishcount']);
Route::get('/',[FrontendUserController::class,'index']);
Route::get('/category',[FrontendUserController::class,'category']);
Route::get('/view-category/{slug}',[FrontendUserController::class,'viewcategory']);
Route::get('/category/{cat_slug}/{prod_slug}',[FrontendUserController::class,'viewproduct']);
Route::get('product-list',[FrontendUserController::class,'productListAjax']);
Route::post('searchProduct',[FrontendUserController::class,'searchProduct']);
// searchProduct
// ------------------------------CART AND WISH LIST------------------------------------------------
Route::post('add-to-wishlist',[WishlistController::class,'store']);
Route::post('delete-wishlist-item',[WishlistController::class,'delete']);
Route::resource('/cart',CartController::class);
Route::post('add-rating',[RatingController::class,'store']);
Route::post('/add-review',[ReviewController::class,'store']);
Route::get('/add-review/{slug}/userreview',[ReviewController::class,'add']);
Route::get('/edit-review/{slug}/userreview',[ReviewController::class,'edit']);
Route::middleware('can:isUser')->group(function(){
    Route::post('/delete-cart-item',[CartController::class,'deleteprod']);
    Route::post('/update-cart',[CartController::class,'updatecart']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::post('/place-order',[CheckoutController::class,'placeorder']);
    Route::get('/my-orders',[UserController::class,'index']);
    Route::get('/view-order/{id}',[UserController::class,'view']);
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::put('/update-review',[ReviewController::class,'update']);
    Route::post('/proccess-to-pay',[CheckoutController::class,'razorpay']);
    Route::get('profile/{id}',[ProfileController::class,'profile']);
    Route::put('edit/{id}',[ProfileController::class,'edit']);
});
// ------------------------------ADMIN------------------------------------------------
Route::middleware('can:isAdmin')->group(function(){
    Route::get('/dashboard',[FrontendController::class,'index']);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('orders',OrderController::class);
    Route::get('order-history',[OrderController::class,'orderhistory']);
    Route::get('users',[DashboardController::class,'users']);
    Route::get('view-user/{id}',[DashboardController::class,'viewuser']);
});

