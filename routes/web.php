<?php

use App\Http\Controllers\DashboardBookingController;
use App\Http\Controllers\DashboardCabangController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\DashboardKasirController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\ReportPelangganController;
use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\Service;
use Illuminate\Routing\RouteGroup;
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
    return view('home/index', [
        'services' => Service::all(),
        'cabangs' => Cabang::all(),
        'karyawans' => Karyawan::where('cabang_id', '<>', null)->get()
    ]);
});

Route::get('/appointment', [HomeController::class, 'appointment'])->middleware('auth');
Route::post('/appointment', [HomeController::class, 'appointment_make'])->middleware('auth');
Route::get('/appointment/service/{id}', [HomeController::class, 'appointment_service']);
Route::post('/appointment/service/{id}', [HomeController::class, 'appointment_service_make']);
Route::delete('/appointment/service/{id}', [HomeController::class, 'appointment_service_delete']);
Route::get('/appointment/jadwal/{id}', [HomeController::class, 'appointment_jadwal']);
Route::post('/appointment/jadwal', [HomeController::class, 'appointment_jadwal_make']);

Route::get('/about', function () {
    return view('home/about');
});

Route::get('/registrasi', [RegistrasiController::class, 'index']);
Route::post('/registrasi', [RegistrasiController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('karyawan');

Route::get('dashboard/kasir/{id}', [DashboardKasirController::class, 'bayar'])->middleware('karyawan');

Route::resource('/dashboard/cabang', DashboardCabangController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/service', DashboardServiceController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/karyawan', DashboardKaryawanController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/booking', DashboardBookingController::class)->except('show')->middleware('karyawan');
Route::resource('/dashboard/kasir', DashboardKasirController::class)->except('show')->middleware('karyawan');

Route::get('/dashboard/pelangganl', [ReportPelangganController::class, 'index'])->middleware('admin');
