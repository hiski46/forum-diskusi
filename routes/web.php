<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PegawaiController;


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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return view('auth/login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('menu.home');
    });
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/add-pegawai', [PegawaiController::class, 'halamanTambah']);
    Route::post('/add-pegawai', [PegawaiController::class, 'tambah']);
    Route::get('/edit-pegawai/{id}', [PegawaiController::class, 'halamanEdit']);
    Route::post('/edit-pegawai/{id}', [PegawaiController::class, 'edit']);
    Route::get('/delete-pegawai/{id}', [PegawaiController::class, 'delete']);
    Route::get('/reset-password/{id}', [PegawaiController::class, 'resetPassword']);

});
