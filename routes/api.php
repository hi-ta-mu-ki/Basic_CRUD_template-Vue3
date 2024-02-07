<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FruitsController;
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
    Route::get('/fruits/list',[FruitsController::class,'list']);
    Route::put('/fruits/update/{fruit}',[FruitsController::class,'update']);
    Route::post('/fruits/create',[FruitsController::class,'create']);
    Route::delete('/fruits/delete/{fruit}',[FruitsController::class,'delete']);

    Route::get('/auth/list',[UsersController::class,'list']);
    Route::post('/auth/create',[UsersController::class,'create']);
    Route::get('/auth/user',[UsersController::class,'user']);
    Route::patch('/auth/update',[UsersController::class,'update']);
    Route::put('/auth/password', [PasswordController::class, 'update']);
});