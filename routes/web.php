<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;
Route::post('/notes', [NoteController::class, 'store']);
Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/notes/home', [NoteController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
