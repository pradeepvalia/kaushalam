<?php
use App\Modules\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;




Route::prefix('/admin/category')->group(function() {
    Route::group(["middleware" => ["auth"]], function(){
    Route::get('/', 'CategoryController@index')->name('category.index');
Route::get('addcategory', [CategoryController::class,'formdata'])->name('category.add');
Route::post('addcategory', [CategoryController::class,'getdata'])->name('category.save');
Route::post('deletecategory/', [CategoryController::class,'deletedata'])->name('category.delete');
Route::post('/restore', [CategoryController::class,'restore_data'])->name('category.restore');
// changeStatus
Route::post('/changestatus', [CategoryController::class,'changestatus']);
Route::get('/edit/{id}', [CategoryController::class,'edit']);
Route::post('/update/{id}', [CategoryController::class,'update']);
Route::get('/trash', 'CategoryController@showtrash')->name('category.showtrash');
Route::post('/restoretrash', 'CategoryController@restoretrash')->name('category.restoretrash');
Route::get('/uniquename',[Categorycontroller::class,'uniquename']);



});
});
