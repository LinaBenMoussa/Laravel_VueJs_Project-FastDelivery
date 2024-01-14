<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReservationTableController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
Route::resource('foods', FoodController::class);
});
Route::middleware('api')->group(function () {
Route::resource('menus', MenuController::class);
    });
Route::middleware('api')->group(function () {
Route::resource('restaurants', RestaurantController::class);
        });
Route::middleware('api')->group(function () {
Route::resource('tables', TableController::class);
});
Route::middleware('api')->group(function () {
Route::resource('reservationtable', ReservationTableController::class);
    });
Route::middleware('api')->group(function($router) {
Route::post('/createpayment', [PaymentController::class,'createPaymentIntent']);
});
Route::get('/tablesbyrestaurant/{restaurant_id}', [TableController::class,'TableByRestaurant']);
Route::get('/foodsbymenu/{menu_id}', [FoodController::class,'foodsByMenu']);
Route::get('/menusbyrestaurant/{restaurant_id}', [MenuController::class,'MenusByRestaurant']);
Route::get('/reseravationsbyrestaurant/{restaurant_id}', [ReservationTableController::class,'ReservationsByRestaurant']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,'logout']);
Route::get('/reseravationsbyusername/{email}', [ReservationTableController::class,'ReservationsByUsername']);
