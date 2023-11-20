<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route:: post("register", [UserController::class, "register"]);
Route:: post("login", [UserController::class, "login"]);
Route:: post("logout", [UserController::class, "logout"]);


Route::group(["prefix"=>"store","middleware"=>"auth:sanctum"], function(){
    Route::post("add", [StoreController::class, "add"]);
    Route::get("/", [StoreController::class, "index"]);
    Route::get("edit/{id}", [StoreController::class, "edit"]);
    Route::post("update/{id}", [StoreController::class, "update"]);
    Route::delete("delete/{id}", [StoreController::class, "delete"]);
});
