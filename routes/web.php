<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::resource('/contact', ContactController::class);
Route::get('/', function () {
    return view('frontview.home');
});
Route::get('/admin', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mycart', [App\Http\Controllers\CartController::class,'cartview']);

Route::post('/cart', [App\Http\Controllers\CartController::class, 'cart']);
Route::post('/deletecartitem', [App\Http\Controllers\CartController::class, 'removecart']);
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updatecart']);
// fontend
Route::middleware(['auth'])->group(function(){

    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout']);
    Route::post('/getaddress', [App\Http\Controllers\CheckoutController::class, 'add']);

    Route::get('/shipping', [App\Http\Controllers\CheckoutController::class, 'shipping']);
    Route::post('/getshipping', [App\Http\Controllers\CheckoutController::class, 'getshipping']);


    Route::get('/order', [App\Http\Controllers\CheckoutController::class, 'orderreview']);
    Route::get('/payment', [App\Http\Controllers\CheckoutController::class, 'payment']);

    Route::post('/orderplaced', [App\Http\Controllers\CheckoutController::class, 'store_order']);
    Route::get('/showOrder',[App\Http\Controllers\FrontendController::class, 'showOrderDetails']);

    Route::get('/vieworderdetails/{id}', [App\Http\Controllers\FrontendController::class, 'vieworderdetails']);


});

Route::get('/user', [App\Http\Controllers\FrontendController::class, 'user'])->name('frontview.home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.login');
Route::get('/sortProduct', [App\Http\Controllers\FrontendController::class, 'sortProduct']);
Route::get('/products', [App\Http\Controllers\FrontendController::class, 'list_grid'])->name('frontview.slider');
Route::get('/{url}', [App\Http\Controllers\FrontendController::class, 'detail'])->name('frontview.detail');


