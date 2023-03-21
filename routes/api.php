<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;

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

Route::resources([
    '/products' => ProductController::class,
    '/categories' => CategoryController::class,
]);
Route::get('/images', [ImageController::class, 'index']);
Route::get('/images/{id}', [ImageController::class, 'show']);
Route::post('/images/{id}', [ImageController::class, 'update']);
Route::post('/images', [ImageController::class, 'store']);
Route::delete('/images/{id}', [ImageController::class, 'destroy']);