<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add/column',[App\Http\Controllers\ColumnController::class,'create']);
Route::post('add/card',[App\Http\Controllers\CardController::class,'create1']);
Route::post('delete/column/{id}',[App\Http\Controllers\ColumnController::class,'destroy']);
// Route::post('create1/card',[App\Http\Controllers\CardController::class,'create1']);
// Route::get('list/column',[App\Http\Controllers\ColumnController::class,'index']);
Route::get('list/column',[App\Http\Controllers\CardController::class,'index']);
Route::get('list/particularcolumn/{id}',[App\Http\Controllers\CardController::class,'show']);
Route::post('edit/particularcolumn/{id}',[App\Http\Controllers\CardController::class,'edit']);

// Route::get('list/particularcolumn/{id}',[App\Http\Controllers\CardController::class,'edit']);
Route::get('dbExport',[App\Http\Controllers\CardController::class,'dbExport']);