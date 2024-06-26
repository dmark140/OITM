<?php

use App\Http\Controllers\API\Category\ItemListPerCategoryController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('categoryPerItem', ItemListPerCategoryController::class);
});
