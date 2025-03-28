<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\blogsController;
use App\Http\Controllers\masterController;
use App\Http\Controllers\pembinaController;
use App\Http\Controllers\pengurusController;
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
Route::middleware(['auth', 'role:master'])->prefix('admin/master')->group(function () {
    Route::get('/masterDashboard', [masterController::class, 'index']);
    Route::get('/get-users', [masterController::class, 'getUsers']);
    Route::get('/dataBlogs', [masterController::class, 'getBlogs'])->name('get.blogs');
    Route::get('/bannedBlogs', [masterController::class, 'bannedBlogs'])->name('get.bannedBlogs');
    Route::put('/banBlogs/{id}', [masterController::class, 'banBlog'])->name('blog.ban');
    Route::delete('/destroyBlog/{id}', [pengurusController::class, 'destroy'])->name('blog.destroy');
    Route::get('/masterDataPembina', [masterController::class, 'dataPembina']);
    Route::get('/masterDataPengurus', [masterController::class, 'dataPengurus']);
    Route::post('/savePembina', [masterController::class, 'savePembina'])->name('save.pembina');
    Route::post('/savePengurus', [masterController::class, 'savePengurus'])->name('save.pengurus');
    Route::put('/editPembina/{id}', [masterController::class, 'updatePembina'])->name('update.pembina');
    Route::put('/editPengurus/{id}', [masterController::class, 'updatePengurus'])->name('update.pengurus');
    Route::delete('/hapusPembina/{id}', [masterController::class, 'deletePembina']);
    Route::get('/masterDataEkskul', [masterController::class, 'dataEkskul']);
    Route::post('/saveEkskul', [masterController::class, 'saveEkskul'])->name('save.ekskul');
    Route::get('/ekskul/{id}/dataEdit', [masterController::class, 'dataEdit'])->name('ekskul.dataEdit');
    Route::put('/updateEkskul/{id}', [masterController::class, 'updateEkskul'])->name('ekskul.update');
    Route::delete('/hapusEkskul/{id}', [masterController::class, 'deleteEkskul']);
});
// end Dashboard Master

// Role Pembina START
Route::middleware(['auth', 'role:pembina'])->prefix('admin/pembina')->group(function () {
    Route::get('/pembinaDashboard', [pembinaController::class, 'getDashboardPembina']);
    Route::get('/dataAnggotaEskul', [pembinaController::class, 'getDataAnggotaEskul']);
    Route::post('/saveAnggota', [pembinaController::class, 'saveAnggota']);
    Route::post('/updateAnggota/{id}', [pembinaController::class, 'updateAnggota'])->name('update.anggota');
    Route::put('/updateAnggota/{id}', [pembinaController::class, 'updateAnggota'])->name('update.anggota');
    Route::delete('/hapusAnggota/{id}', [pembinaController::class, 'deleteAnggota']);
    Route::get('/api/jurusan', [pembinaController::class, 'getJurusan']);
    Route::get('/dataInformasiEskul', [pembinaController::class, 'getDataInformasiEskul']);
    Route::post('/saveDataInformasiEkskul', [pembinaController::class, 'saveDataInformasiEkskul'])->name('saveDataInformasiEkskul');
    Route::post('/saveDataStrukturEkskul', [pembinaController::class, 'saveDataStrukturEkskul'])->name('saveDataStrukturEkskul');
    Route::post('/saveJadwalEkskul', [pembinaController::class, 'saveJadwalEkskul'])->name('saveJadwalEkskul');
    Route::get('/dataStrukturEskul', [pembinaController::class, 'getDataStrukturEskul']);
    Route::get('/rekapAbsen', [pembinaController::class, 'rekapAbsen'])->name('pembina.rekapAbsen');
});
// Role Pembina END

// Role Pengurus START
Route::middleware(['auth', 'role:pengurus'])->prefix('admin/pengurus')->group( function (){
    Route::get('/pengurusDashboard', [pengurusController::class, 'getDashboardPengurus']);
    Route::get('/dataBlogs', [pengurusController::class, 'Blogs'])->name('blogs.data');
    Route::get('/absenAnggota', [pengurusController::class, 'absenAnggota'])->name('pengurus.absenAnggota');
    Route::get('/rekapAbsen', [pengurusController::class, 'rekapAbsen'])->name('pengurus.rekapAbsen');
    Route::post('/saveBlog', [pengurusController::class, 'store'])->name('blog.store');
    Route::delete('/destroyBlog/{id}', [pengurusController::class, 'destroy'])->name('blog.destroy');
    Route::post('/submitAbsen/{id}', [pengurusController::class, 'submitAbsen'])->name('pengurus.submitAbsen');
});
// Role Pengurus END

// Dashboard Users
Route::get('/',[blogsController::class, 'Blogs'])->name('mainEkskul');
Route::get('/semuaBerita',[blogsController::class, 'AllBlogs'])->name('semuaBerita');
Route::get('/search-blogs', [blogsController::class, 'search'])->name('blogs.search');
Route::get('/listEkskul', [blogsController::class, 'ekskuls'])->name('ekskuls.all');
Route::get('/dataEkskul/{id}', [blogsController::class, 'EkskulBlogs'])->name('ekskuls.blogs');
Route::get('/detailBlog/{id}', [blogsController::class, 'detailBlog'])->name('blogs.detail');

Route::get('/mainBlog', function () {
    return view('users/mainBlog');
})->name('Berita');

Route::get('/tentangWebsite', function () {
    return view('users/tentangWebsite');
})->name('tentangWebsite');
// end Dashboard Users

Route::get('/dataPembina', function () {
    return view('dataPembina');
});
Route::get('/daftarEkskul', function () {
    return view('daftarEkskul');
});
