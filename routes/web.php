<?php

use App\Http\Controllers\{BarangController, Barang_MasukController, DashboardController, KondisiController, LaporanController, UserController, PindahBarangController, RuanganController};
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
// hanya admin yang dapat akses route ini
Route::resource('/user', UserController::class);
Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

Route::get('/laporan/barang', [LaporanController::class, "view_barang"])->name('laporan.barang');
Route::post('/laporan/barang', [LaporanController::class, "barang"])->name('laporan.barang');

Route::get('/laporan/letak-barang/', [LaporanController::class, "view_letak_barang"])->name('laporan.letak-barang');
Route::post('/laporan/letak-barang/', [LaporanController::class, "letak_barang"])->name('laporan.letak-barang');

Route::get('/laporan/barang-rusak/', [LaporanController::class, "view_barang_rusak"])->name('laporan.barang_rusak');
Route::post('/laporan/barang-rusak/', [LaporanController::class, "barang_rusak"])->name('laporan.rusak');

Route::get('/laporan/ruangan/', [LaporanController::class, "view_ruangan"])->name('laporan.ruangan');
Route::post('/laporan/ruangan/', [LaporanController::class, "ruangan"])->name('laporan.ruangan');

Route::get('/laporan/kondisi/', [LaporanController::class, "view_kondisi"])->name('laporan.kondisi');
Route::post('/laporan/kondisi/', [LaporanController::class, "kondisi"])->name('laporan.rusak');

Route::get('/barang/hapus/{id}', [BarangController::class, "delete"]);
Route::get('/ruangan/hapus/{id}', [RuanganController::class, "destroy"]);


Route::resource('/ruangan', RuanganController::class);
Route::resource('/pindah-barang', PindahBarangController::class);
Route::get('/pindah-barang/hapus/{id}', [PindahBarangController::class, "destroy"]);

Route::resource('/kondisi', KondisiController::class);
Route::get('/kondisi/hapus/{id}', [KondisiController::class, "destroy"]);

Route::resource('/barang', BarangController::class);
Route::resource('/barang_masuk', Barang_MasukController::class);

Route::get('/barang_masuk/hapus/{id}', [Barang_MasukController::class, "delete"]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');