<?php

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

// Dashboard Master
Route::get('/', function () {
    return view('master/masterDashboard');
});
Route::get('/daftarEkskul', function () {
    return view('master/daftarEkskul');
});
Route::get('/pembinaEkskul', function () {
    return view('master/pembinaEkskul');
});

// end Dashboard Master




Route::get('/dataPembina', function () {
    return view('dataPembina');
});

Route::get('/dataEkskul', function () {
    return view('dataEkskul');
});
