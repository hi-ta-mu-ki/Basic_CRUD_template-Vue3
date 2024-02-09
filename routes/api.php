<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\A_masterController;
use App\Http\Controllers\B_masterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\PasswordController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/a_master/list',[A_masterController::class,'list']);
    Route::put('/a_master/update/{a_master}',[A_masterController::class,'update']);
    Route::post('/a_master/create',[A_masterController::class,'create']);
    Route::delete('/a_master/delete/{a_master}',[A_masterController::class,'delete']);

    Route::get('/b_master/list',[B_masterController::class,'list']);
    Route::put('/b_master/update/{b_master}',[B_masterController::class,'update']);
    Route::post('/b_master/create',[B_masterController::class,'create']);
    Route::delete('/b_master/delete/{b_master}',[B_masterController::class,'delete']);

    Route::get('/auth/list',[UsersController::class,'list']);
    Route::post('/auth/create',[UsersController::class,'create']);
    Route::patch('/auth/update/{user}',[UsersController::class,'update']);
    Route::put('/auth/password/{user}', [PasswordController::class, 'update']);
    Route::delete('/auth/delete/{user}',[UsersController::class,'delete']);
});