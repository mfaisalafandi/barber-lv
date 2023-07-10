<?php

use App\Http\Controllers\DashboardCabangController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
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
    return view('home/index');
});

Route::get('/about', function () {
    return view('home/about');
});

Route::get('/registrasi', [RegistrasiController::class, 'index']);
Route::post('/registrasi', [RegistrasiController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/cabang', DashboardCabangController::class)->except('show')->middleware('auth');
Route::resource('/dashboard/service', DashboardServiceController::class)->except('show')->middleware('auth');
Route::resource('/dashboard/karyawan', DashboardKaryawanController::class)->except('show')->middleware('auth');
