<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\homeController;

Route::resource('home', homeController::class);
Route::get('/', function () {
  return redirect('home');
});

Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login', [loginController::class,'login']);

Route::resource('user', userController::class);

