<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FruitsController;

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

Route::get('/list',[FruitsController::class,'list']);
Route::put('/update/{fruit}',[FruitsController::class,'update']);
Route::post('/create',[FruitsController::class,'create']);
Route::delete('/delete/{fruit}',[FruitsController::class,'delete']);