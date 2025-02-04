<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\masterController;
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

// Auth Route
Route::get('/login', [authController::class, 'index'])->name('login');
Route::post('/loginn', [authController::class, 'login']);
//logout
Route::get('/logout', [authController::class, 'logout']);
// end Auth Route

// Dashboard Master
Route::get('/masterDashboard', [masterController::class, 'index']);
Route::get('/masterDataPembina', [masterController::class, 'dataPembina']);
Route::get('/listEkskul', function () {
    return view('master/listEkskul');
});
// end Dashboard Master

// Dashboard Users
Route::get('/detailEkskul', function () {
    return view('users/detailEkskul');
})->name('detailEkskul');

Route::get('/daftarEkskul', function () {
    return view('users/daftarEkskul');
})->name('daftarEkskul');

Route::get('/tentangWebsite', function () {
    return view('users/tentangWebsite');
})->name('tentangWebsite');

// end Dashboard Users
Route::get('/dataPembina', function () {
    return view('dataPembina');
});
Route::get('/dataEkskul', function () {
    return view('dataEkskul');
});
