<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ...
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/', function (Request $request) {
//    $message = 'Loading welcome page';
//    Log::info($message);
//    $request->session()->flash('info', $message);
//    return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::resource('files', FileController::class)
    ->middleware(['auth', 'permission:files']);

Route::resource('places', PlaceController::class)
    ->middleware(['auth', 'permission:places']);

Route::resource('posts', PostController::class)
    ->middleware(['auth', 'permission:posts']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';


 
require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'language']);