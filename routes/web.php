<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/migrate', function () {

    return Artisan::call('migrate');
});
Route::get('/migrate-refresh', function () {
    return Artisan::call('migrate:refresh');
});
Route::get('/seed', function () {
    return Artisan::call('db:seed');
});
Route::get('/simbolik', function () {
    return Artisan::call('storage:link');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home', ['hide_sidebar' => 1]);
    });
    Route::get('/logout', [AuthController::class, 'logout']);


    Route::get('/forum', [ForumController::class, 'index']);
    Route::get('/tambah-forum', [ForumController::class, 'halamanTambahForum']);
    Route::post('/tambah-forum', [ForumController::class, 'tambahForum']);
    Route::get('/edit-forum/{id}', [ForumController::class, 'halamanEditForum']);
    Route::post('/edit-forum/{id}', [ForumController::class, 'editForum']);
    Route::get('/detail-forum/{id}', [ForumController::class, 'detailForum']);
    Route::get('/get-forum', [ForumController::class, 'getForum']);
    Route::post('/send-comment/{id}', [ForumController::class, 'sendComment']);
    Route::get('/delete-forum/{id}', [ForumController::class, 'deleteForum']);
    Route::get('/approve-forum', [ForumController::class, 'halamanApprove']);
    Route::get('/approve/{id}', [ForumController::class, 'approveForum']);
    Route::get('/reject/{id}', [ForumController::class, 'rejectForum']);



    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/self-edit', [PegawaiController::class, 'halamanSelfEdit']);
    Route::post('/self-edit', [PegawaiController::class, 'selfEdit']);
    Route::get('/add-pegawai', [PegawaiController::class, 'halamanTambah']);
    Route::post('/add-pegawai', [PegawaiController::class, 'tambah']);
    Route::get('/edit-pegawai/{id}', [PegawaiController::class, 'halamanEdit']);
    Route::post('/edit-pegawai/{id}', [PegawaiController::class, 'edit']);
    Route::get('/delete-pegawai/{id}', [PegawaiController::class, 'delete']);
    Route::get('/reset-password/{id}', [PegawaiController::class, 'resetPassword']);
});
