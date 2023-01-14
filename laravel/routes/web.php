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
    return redirect('/posts');
})->name('dashboard');

Route::get('/dashboard', function (){
    return redirect('/');
});

Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
});

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
    ->middleware(['auth']);

Route::resource('places', PlaceController::class);

Route::resource('posts', PostController::class);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';


 
require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'language']);

Route::post('/places/{place}/favourite', [App\Http\Controllers\PlaceController::class, 'favourite'])->name('places.favourite');
Route::delete('/places/{place}/favourite', [App\Http\Controllers\PlaceController::class, 'unfavourite'])->name('places.unfavourite');

Route::post('/posts/{post}/like', [App\Http\Controllers\PostController::class, 'like'])->name('posts.like');
Route::delete('/posts/{post}/like', [App\Http\Controllers\PostController::class, 'unlike'])->name('posts.unlike');

Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
});