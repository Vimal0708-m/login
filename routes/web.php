<?php

use App\Http\Controllers\AuthLoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthLoginController::class, 'login'])->name('login');
Route::post('/login', [AuthLoginController::class,'checklogin'])->name('login.check');
Route::get('/register', [AuthLoginController::class, 'create'])->name('register');
Route::post('/register', [AuthLoginController::class,'store'] )->name('register.store');
Route::get('/dashboard', [AuthLoginController::class, 'dashboard'])
    ->name('dashboard');
Route::get('/logout', [AuthLoginController::class, 'logout'])
    ->name('logout');
Route::get('/profile/edit', [AuthLoginController::class,'edit'])->name('profile.edit');
Route::put('/profile/update', [AuthLoginController::class,'update'] )->name('profile.update');
// Route::delete('/profile/destroy', [AuthLoginController::class,'destroy'] )->name('profile.destroy');
