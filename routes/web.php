<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;


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
Route::get('/', [FrontendController::class, 'index']); 
Route::get('category', [FrontendController::class, 'category']); 
Route::get('view-category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{product_slug}', [FrontendController::class, 'productview']); 

Route::get('product-list', [FrontendController::class, 'productlistAjax']); 
Route::post('searchproduct',[FrontendController::class,'searchproduct']);

Auth::routes();
Route::get('load-cart-count', [CartController::class,'cartcount'] );
Route::get('load-wishlist-count', [WishlistController::class,'wishlistcount'] );

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add-to-cart', [CartController::class,'addProduct'] );
Route::post('delete-cart-item', [CartController::class,'deleteProduct'] );
Route::post('update-cart', [CartController::class,'updatecart'] );
Route::post('add-to-wishlist',[WishlistController::class,'add']);
Route::post('delete-wishlist-item',[WishlistController::class,'deleteitem']);
Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class,'viewcart'] );
    Route::get('checkout', [CheckoutController::class,'index'] );
    Route::post('place-order', [CheckoutController::class,'placeorder'] );
    Route::get('my-orders', [UserController::class,'index'] );
    Route::get('view-order/{id}', [UserController::class,'view'] );
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::post('proceed-to-pay', [CheckoutController::class,'razorpaycheck'] );
    Route::post('add-rating',[RatingController::class,'add']);
    Route::get('add-review/{product_slug}/userreview', [ReviewController::class,'add'] );
    Route::post('add-review', [ReviewController::class,'create'] );
    Route::get('edit-review/{product_slug}/userreview', [ReviewController::class,'edit'] );
    Route::put('update-review', [ReviewController::class,'update'] );

});

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', 'Admin\frontendController@index');

    Route::get('categories', 'Admin\CategoriesController@index');
    Route::get('add-category', 'Admin\CategoriesController@add');
    Route::post('insert-category', 'Admin\CategoriesController@insert');
    Route::get('edit-category/{id}', [CategoriesController::class,'edit'] );
    Route::put('update-category/{id}', [CategoriesController::class,'update'] );
    Route::get('delete-category/{id}', [CategoriesController::class,'destroy'] );

    Route::get('products', [productController::class,'index'] );
    Route::get('add-products', [productController::class,'add'] );
    Route::post('insert-products', [productController::class,'insert'] );
    Route::get('edit-product/{id}', [productController::class,'edit'] );
    Route::put('update-product/{id}', [productController::class,'update'] );
    Route::get('delete-product/{id}', [productController::class,'destroy'] );

    Route::get('orders', [OrderController::class,'index'] );
    Route::get('admin/view-order/{id}',[OrderController::class,'view']); 
    Route::put('update-order/{id}',[OrderController::class,'updateorder']); 
    Route::get('order-history',[OrderController::class,'orderhistory']);
    Route::get('users',[DashboardController::class,'users']); 
    Route::get('view-user/{id}',[DashboardController::class,'viewuser']);

    
 });
