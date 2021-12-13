<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/users', 'users.showAll')->name('user.all');

Route::view('/game', 'game.show')->name('game.show');

Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
Route::post('/chat/message', [ChatController::class, 'messageReceived'])->name('chat.message');
