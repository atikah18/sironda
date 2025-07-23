<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\editUserController;

Route::resource('home', homeController::class);
Route::resource('jadwal', jadwalController::class);
Route::get('/', function () {
  return redirect('home');
});

Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login', [loginController::class,'login']);
Route::resource('user', userController::class);
Route::middleware(['auth'])->group(function(){
//   Route::get('/jadwal', function () {
//   return view('sironda.jadwal');
// });

Route::resource('edituser', editUserController::class);

 Route::get('/logout', [loginController::class, 'logout']);
 });