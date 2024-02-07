<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');

    // facebook login
    Route::get('/auth/redirect', 'redirect')->name('auth.redirect');
    Route::get('/auth/callback', 'callback')->name('auth.callback');
});

Route::group([
	'middleware' => 'loginauth',
], function ($router) {
    Route::get('/dashboard', HomeController::class .'@index')->name('index');
    Route::get('/search', HomeController::class .'@search')->name('search');
    Route::get('/viewMovie/{id}', HomeController::class .'@viewMovie')->name('viewMovie');
    Route::get('/likedList/{id}', HomeController::class .'@likedList')->name('likedList');
    Route::post('/likeMovie', HomeController::class .'@likeMovie')->name('likeMovie');
    Route::post('/unlikeMovie', HomeController::class .'@unlikeMovie')->name('unlikeMovie');
    Route::get('/create', HomeController::class .'@create')->name('Create');
    Route::post('/save', HomeController::class .'@save')->name('save');
});
