<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\masterController;
use App\Http\Controllers\pembinaController;
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
Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/loginn', [authController::class, 'login']);
//logout
Route::get('/logout', [authController::class, 'logout']);
// end Auth Route

// Dashboard Master
Route::get('/masterDashboard', [masterController::class, 'index']);
Route::get('/get-users', [masterController::class, 'getUsers']);
Route::get('/masterDataPembina', [masterController::class, 'dataPembina']);
Route::post('/savePembina', [masterController::class, 'savePembina'])->name('save.pembina');
Route::put('/editPembina/{id}', [masterController::class, 'updatePembina'])->name('update.pembina');
Route::delete('/hapusPembina/{id}', [masterController::class, 'deletePembina']);
Route::get('/masterDataEkskul', [masterController::class, 'dataEkskul']);
Route::post('/saveEkskul', [masterController::class, 'saveEkskul'])->name('save.ekskul');
Route::get('/ekskul/{id}/dataEdit', [masterController::class, 'dataEdit'])->name('ekskul.dataEdit');
Route::put('/updateEkskul/{id}', [masterController::class, 'updateEkskul'])->name('ekskul.update');
Route::delete('/hapusEkskul/{id}', [masterController::class, 'deleteEkskul']);
// end Dashboard Master

// Role Pembina START
Route::get('/dashboardPembina', [pembinaController::class, 'getDashboardPembina']);
Route::get('/dataAnggotaEskul', [pembinaController::class, 'getDataAnggotaEskul']);
Route::post('/saveDataAnggotaEskul', [pembinaController::class, 'createUser']);
Route::put('/editDataAnggotaEskul/{id}', [pembinaController::class, 'updateUser']);
Route::get('/dataInformasiEskul', [pembinaController::class, 'getDataInformasiEskul']);
Route::get('/dataStrukturEskul', [pembinaController::class, 'getDataStrukturEskul']);
// Role Pembina END


// Dashboard Users
Route::get('/mainEkskul', function () {
    return view('users/mainEkskul');
})->name('mainEkskul');

Route::get('/daftarEkskul', function () {
    return view('users/daftarEkskul');
})->name('daftarEkskul');

Route::get('/detailEkskul', function () {
    return view('users/detailEkskul');
})->name('detailEkskul');

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
