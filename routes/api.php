<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProductsController;
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

// Route::get('teste/', function (Request $request) {
//     // dd($request->header->all());

//     $response = new Illuminate\Http\Response(json_encode(['msg' => 'Minha APi']));
//     $response->header('Content-Type', 'application/json');
//     return $response;
// });

Route::controller(ProductsController::class)->prefix('products')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store')->middleware('auth.basic');
    Route::put('/', 'update');
    Route::patch('/', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::resource('/user', UserController::class);
