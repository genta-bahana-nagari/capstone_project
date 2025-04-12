<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/wisata', App\Http\Controllers\Api\WisataController::class);
Route::apiResource('/kategori', App\Http\Controllers\Api\KategoriController::class);

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'registration']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);