<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pemilik\PemilikMobil_Controller;
use App\Http\Controllers\Peminjam\DaftarPeminjaman_Controller;
use App\Http\Controllers\Peminjam\DaftarPengembalian_Controller;
use App\Http\Controllers\Peminjam\PeminjamDataMobil_Controller;
use App\Http\Controllers\RegisterController;

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

Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'halaman_register')->name('Register');
        Route::post('/user-register', 'user_register')->name('UserRegister');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'halaman_login')->name('Login');
        Route::post('/user-login', 'autentikasi')->name('UserLogin');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user-logout', [LoginController::class, 'logout'])->name('LogoutPengguna');

    Route::prefix('pemilik')->name('pemilik.')->middleware(['isPemilik'])->group(function () {
        Route::controller(PemilikMobil_Controller::class)->group(function () {
            Route::get('/data-mobil', 'data_mobil')->name('HalamanDataMobil');
            Route::post('/tambah-data-mobil', 'tambah_data_mobil')->name('TambahDataMobil');
            Route::get('/edit-data-mobil/{kode_mobil}', 'edit_data_mobil')->name('HalamanDataMobil.HalamanEditDataMobil');
            Route::post('/proses-edit-data-mobil', 'proses_edit_data_mobil')->name('ProsesEditDataMobil');
            Route::get('/hapus-data-mobil/{pengguna_id}', 'hapus_data_mobil');
            Route::get('/data-peminjaman', 'data_peminjaman')->name('HalamanDaftarDataPeminjaman');
        });
    });


    Route::prefix('peminjam')->name('peminjam.')->middleware(['isPeminjam'])->group(function () {
        Route::controller(PeminjamDataMobil_Controller::class)->group(function () {
            Route::get('/daftar-mobil', 'daftar_mobil')->name('HalamanDaftarMobil');
            Route::post('/proses-pesan-mobil', 'proses_pesan_mobil')->name('ProsesPesanMobil');
        });

        Route::controller(DaftarPeminjaman_Controller::class)->group(function () {
            Route::get('/daftar-peminjaman', 'daftar_peminjaman')->name('HalamanDaftarPeminjaman');
            Route::post('/proses-pengembalian-mobil', 'proses_pengembalian_mobil')->name('ProsesPengembalianMobil');
        });

        Route::controller(DaftarPengembalian_Controller::class)->group(function () {
            Route::get('/daftar-pengembalian', 'daftar_pengembalian')->name('HalamanDaftarPengembalian');
        });
    });
});
