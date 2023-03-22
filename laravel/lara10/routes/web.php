<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
Route::get('/blogs', 'App\Http\Controllers\BlogController@index')->name('blogs.index');

Route::get('/blogs/create', 'App\Http\Controllers\BlogController@create')->name('blog.create')->middleware('auth');
Route::post('/blogs/store/', 'App\Http\Controllers\BlogController@store')->name('blog.store')->middleware('auth');

Route::get('/blogs/edit/{blog}', 'App\Http\Controllers\BlogController@edit')->name('blog.edit')->middleware('auth');
Route::put('/blogs/edit/{blog}','App\Http\Controllers\BlogController@update')->name('blog.update')->middleware('auth');

Route::delete('/blogs/{blog}','App\Http\Controllers\blogController@destroy')->name('blog.destroy')->middleware('auth');

require __DIR__.'/auth.php';
