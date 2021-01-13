<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


// Auth Route
Route::post('login', ['as' => 'login', 'uses' => '\App\Http\Controllers\Auth\LoginController@login']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login_index');
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register_index');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

// Auth middleware group Route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});