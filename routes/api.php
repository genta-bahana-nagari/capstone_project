<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::apiResource('/wisata', App\Http\Controllers\Api\WisataController::class);
Route::apiResource('/kategori', App\Http\Controllers\Api\KategoriController::class);

Route::post('/register', [AuthController::class, 'registration']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->put('/profile', [AuthController::class, 'updateProfile']);
Route::middleware('auth:api')->put('/password', [AuthController::class, 'updatePassword']);
