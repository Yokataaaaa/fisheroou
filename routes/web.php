<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\KolamController;
use App\Http\Controllers\PembelianPakanController;
use App\Http\Controllers\PenjualanIkanController;
use App\Http\Middleware\CheckAuthToken;

// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', [LoginController::class, 'showLogin'])->name('showLogin');

// Route untuk menangani logout


// Route untuk dashboard awal (tanpa middleware, untuk pengujian)


// Pastikan pengguna sudah login dengan validasi token melalui API eksternal
Route::middleware([CheckAuthToken::class])->group(function () {

    // Route untuk halaman dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route untuk modul Karyawan
    Route::prefix('admin/karyawan')->group(function () {
        Route::get('/', [KaryawanController::class, 'karyawan'])->name('admin.karyawan');
        Route::post('/tambah', [KaryawanController::class, 'tambahKaryawan'])->name('karyawan.tambah');
        Route::get('/edit/{id}', [KaryawanController::class, 'editKaryawan'])->name('karyawan.edit');
        Route::put('/update/{id}', [KaryawanController::class, 'updateKaryawan'])->name('karyawan.update');
        Route::delete('/hapus/{id}', [KaryawanController::class, 'hapusKaryawan'])->name('karyawan.destroy');
        Route::post('/import', [KaryawanController::class, 'import'])->name('admin.karyawan.import');
    });

    // Route untuk modul Produk
    Route::prefix('admin/produk')->group(function () {
        Route::get('/', [ProdukController::class, 'produk'])->name('admin.produk');
        Route::get('/tambah', [ProdukController::class, 'tambahProduk'])->name('produk.tambah');
        Route::post('/store', [ProdukController::class, 'storeProduk'])->name('produk.store');
        Route::get('/edit/{id}', [ProdukController::class, 'editProduk'])->name('produk.edit');
        Route::put('/update/{id}', [ProdukController::class, 'updateProduk'])->name('admin.produk.update');
        Route::delete('/hapus/{id}', [ProdukController::class, 'hapusProduk'])->name('produk.destroy');
    });

    // Daily Task Routes
    
        // Menampilkan halaman task harian
        Route::get('/daily_task', [DailyTaskController::class, 'index'])->name('admin.task');
        Route::get('/daily_task/create', [DailyTaskController::class, 'create'])->name('admin.tambah_task');
        Route::post('/daily_task', [DailyTaskController::class, 'store'])->name('admin.task.store');
        Route::put('/daily_task/{id}', [DailyTaskController::class, 'update'])->name('admin.task.update');
        Route::delete('/daily_task/{id}', [DailyTaskController::class, 'destroy'])->name('admin.task.destroy');

    // Modul Routes
    Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');
    Route::get('/modul/download/{id}', [ModulController::class, 'download'])->name('modul.download');

    // Kolam Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/produk', [ProdukController::class, 'produk'])->name('admin.produk');
    Route::post('/admin/produk', [ProdukController::class, 'storeProduk'])->name('admin.produk.store');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'editProduk'])->name('admin.produk.edit');
    Route::put('/admin/produk/{id}', [ProdukController::class, 'updateProduk'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'hapusProduk'])->name('admin.produk.delete');

    // Pembelian Pakan Routes
    Route::get('/admin/pembelian-pakan', [PembelianPakanController::class, 'index'])->name('admin.pembelian_pakan');
    // Rute untuk menyimpan data pembelian pakan baru
    Route::post('/admin/pembelian-pakan', [PembelianPakanController::class, 'store'])->name('store.pembelian_pakan');
    // Rute untuk menghapus data pembelian pakan
    Route::delete('/admin/pembelian-pakan/{id}', [PembelianPakanController::class, 'destroy'])->name('destroy.pembelian_pakan');

    // Penjualan Ikan Routes
    Route::get('penjualan-ikan', [PenjualanIkanController::class, 'index'])->name('admin.penjualan_ikan');
    Route::get('penjualan-ikan/create', [PenjualanIkanController::class, 'create'])->name('penjualanikan.create');
    Route::post('admin/penjualan-ikan', [PenjualanIkanController::class, 'store'])->name('store.pembelian_ikan');
    Route::delete('penjualan-ikan/{id}', [PenjualanIkanController::class, 'destroy'])->name('penjualanikan.destroy');
    // Menampilkan data penjualan ikan (jika ada halaman khusus untuk itu)
    Route::get('penjualan-ikan/data', [PenjualanIkanController::class, 'dataKeluar'])->name('data_keluar');
    Route::get('/pembelian-pakan', [PembelianPakanController::class, 'index'])->name('data_masuk');


    // Route untuk Produk


    // Route untuk Modul dan Tambah Modul
    Route::get('/admin/modul', [ModulController::class, 'index'])->name('admin.modul');
    Route::post('/admin/modul', [ModulController::class, 'store'])->name('modul.store');
    Route::delete('/admin/modul/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
    Route::put('/admin/modul/{id}', [ModulController::class, 'update'])->name('modul.update');

    Route::get('/admin/tambah-modul', [ModulController::class, 'create'])->name('admin.tambah_modul');
});


Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::post('karyawan/import', [KaryawanController::class, 'import'])->name('karyawan.import');
Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
