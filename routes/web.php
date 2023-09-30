<?php

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
    return redirect()->route('chat');
});

Route::get('/share/{slug?}', [App\Http\Controllers\ShareController::class, 'index'])->name('share.index');

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/chat/{slug?}', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat');
Route::get('/conversations', [App\Http\Controllers\HomeController::class, 'conversations'])->name('conversations');
Route::get('/create-website/{slug}/{messageId}', [App\Http\Controllers\HomeController::class, 'createWebsite'])->name('create-website');


Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'myAccount'])->name('my-account');

Route::post('/my-account-post', [App\Http\Controllers\HomeController::class, 'myAccountPost'])->name('my-account-post');
