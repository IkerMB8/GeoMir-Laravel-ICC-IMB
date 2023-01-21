<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\TokenController;
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

Route::get('user', [TokenController::class, 'user'])->middleware(['auth:sanctum']);
Route::post('logout', [TokenController::class, 'logout'])->middleware(['auth:sanctum']);
Route::post('login', [TokenController::class, 'login']);
Route::post('register', [TokenController::class, 'register']);

Route::apiResource('files', FileController::class)->middleware(['auth:sanctum']);

Route::apiResource('places', PlaceController::class);
Route::post('/places/{place}/favourite', [PlaceController::class, 'favourite'])->middleware(['auth:sanctum']);
Route::delete('/places/{place}/favourite', [PlaceController::class, 'unfavourite'])->middleware(['auth:sanctum']);
Route::post('/places/{place}/review', [PlaceController::class, 'review'])->middleware(['auth:sanctum']);
Route::delete('/places/{place}/review', [PlaceController::class, 'unreview'])->middleware(['auth:sanctum']);

Route::apiResource('posts', PostController::class);
Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware(['auth:sanctum']);
Route::delete('/posts/{post}/like', [PostController::class, 'unlike'])->middleware(['auth:sanctum']);
Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->middleware(['auth:sanctum']);
Route::delete('/posts/{post}/comment', [PostController::class, 'uncomment'])->middleware(['auth:sanctum']);