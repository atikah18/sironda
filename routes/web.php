<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\editUserController;
use App\Http\Controllers\addInfoController;
use App\Http\Controllers\tasksController;
use App\Http\Controllers\reportsController;

Route::resource('home', homeController::class);
Route::resource('jadwal', jadwalController::class);
Route::get('/', function () {
  return redirect('home');
});

Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login', [loginController::class,'login']);
Route::middleware(['auth'])->group(function(){
//   Route::get('/jadwal', function () {
//   return view('sironda.jadwal');
// });
Route::resource('addInfo', addInfoController::class);
Route::resource('penjadwalan', tasksController::class);
// Route::get('/reports', reportsController::class);
Route::get('/reports/create/{id}', [reportsController::class, 'create'])
     ->name('reports.create');
Route::get('/reports', [reportsController::class, 'index'])->name('reports.index');
Route::post('/reports', [reportsController::class, 'store'])->name('reports.store');
Route::get('/reports/{id}', [reportsController::class, 'show'])->name('reports.show'); // pakai show untuk edit
Route::put('/reports/{id}', [reportsController::class, 'update'])->name('reports.update');
Route::delete('/reports/{id}', [reportsController::class, 'destroy'])->name('reports.destroy');

Route::resource('user', userController::class);
Route::resource('edituser', editUserController::class);

 Route::get('/logout', [loginController::class, 'logout']);
 });