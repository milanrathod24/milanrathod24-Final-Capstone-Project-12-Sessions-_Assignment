<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\subapicontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/category', [apiController::class, 'index']);
Route::post('/category/save', [apiController::class, 'store']);
Route::put('/category/{id}/update', [apiController::class, 'update']);
Route::patch('/category/{id}/edit', [apiController::class, 'edit']);
Route::delete('/category/{id}/delete', [apiController::class, 'destroy']);

Route::post('/send-email', [apiController::class, 'sendEmail']);

Route::get('/subcategory', [subapicontroller::class, 'index']);
Route::post('/subcategory/save', [subapicontroller::class, 'store']);
Route::put('/subcategory/{id}/update', [subapicontroller::class, 'update']);
Route::patch('/subcategory/{id}/edit', [subapicontroller::class, 'edit']);
Route::delete('/subcategory/{id}/delete', [subapicontroller::class, 'destroy']);