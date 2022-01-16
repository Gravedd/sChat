<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use \App\Http\Controllers\ChatController;
use \App\Http\Controllers\dialogueslistController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [dialogueslistController::class, 'index']);
Route::get('/chat/{userid}', [ChatController::class, 'index']);
Route::post('/chatapi', [ChatController::class, 'getJson']);
Route::post('/chatapi/sendmess', [ChatController::class, 'sendMessage']);
Route::post('/chatapi/checknew', [ChatController::class, 'checknew']);




Route::get('search', [UsersController::class, 'search']);
Route::get('/user/{userid}', [UsersController::class, 'profile']);

