<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CheckOutController;

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


Route::controller(CheckOutController::class)->group(function () {
    Route::post('/checkout-price', 'getCheckoutPriceDetail');
    Route::post('/scan-order', 'scanOrderDetail');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
