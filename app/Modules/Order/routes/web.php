<?php

use Illuminate\Support\Facades\Route;




Route::prefix('/admin/order')->group(function() {
    Route::group(["middleware" => ["auth","adminmiddleware"]], function(){

        Route::get('/orderview', 'OrderController@welcome')->name('order.index');
        Route::get('/invoice/{id}', [App\Modules\Order\Http\Controllers\OrderController::class, 'invoice']);

        Route::get('/edit/{id}', [App\Modules\Order\Http\Controllers\OrderController::class, 'edit']);
        Route::post('/update/{id}', [App\Modules\Order\Http\Controllers\OrderController::class,'update']);
});
});
