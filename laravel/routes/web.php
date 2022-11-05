<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
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
Route::get('/', function (Request $request) {
   $message = 'Loading welcome page';
   Log::info($message);
   $request->session()->flash('info', $message);
   return view('welcome');
});
Route::resource('files', FileController::class)->middleware(['auth', 'role:2,3']);
Route::get('places', [PlaceController::class, 'index'])->name('places.index');
Route::get('places/create', [PlaceController::class, 'create'])->name('places.create')->middleware(['auth', 'role:1']);
Route::post('places', [PlaceController::class, 'store'])->name('places.store')->middleware(['auth', 'role:1']);
Route::get('places/{place}', [PlaceController::class, 'show'])->name('places.show');
Route::get('places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit')->middleware(['auth', 'role:1']);
Route::put('places/{place}', [PlaceController::class, 'update'])->name('places.update')->middleware(['auth', 'role:1']);
Route::delete('places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
 
require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
