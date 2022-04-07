<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin/users')->group(function () {
    Route::group(["middleware" => ["auth", "adminmiddleware"]], function () {
        Route::get('/showusers', 'UsersController@welcome');
    });
});
