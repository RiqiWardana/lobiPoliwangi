<?php

use Illuminate\Support\Facades\Route;

// Import Class Controller //
use App\Http\Controllers\web\authController;
use App\Http\Controllers\web\adminController;
use App\Http\Controllers\web\dataController\beasiswaModelController;
use App\Http\Controllers\web\dataController\lombaController;  
use App\Http\Controllers\web\dataController\prestasiModelController;  

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

// Struktur Route Web //

// Middleware Admin //
Route::get('/', function () {
    
});
Route::get('/login-admin', [authController::class, 'pageLoginForAdmin'])->name('loginAdmin'); // Route Page Login Untuk Admin //
Route::Post('/login-admin', [authController::class, 'authentikasiUserAdmin']); // Route Auth Login Untuk Admin //
Route::get('/my-profile/logout-admin', [authController::class, 'logoutAccount']); // Route Auth logout Untuk Admin //

Route::get('/dashboard-admin', [adminController::class, 'indexDashboard']); // Route Ke Dashbard Untuk Admin //
Route::get('/dashboard-admin/index-data-beasiswa', [adminController::class, 'indexTableBeasiswa'])->name('indexTableDataBeasiswa'); // Route Ke Dashbard Untuk Admin //
Route::get('/dashboard-admin/tambah-data-beasiswa', [adminController::class, 'formTambahDataBeasiswa']); // Route Untuk Tambah Data Beasiswa //
Route::post('/dashboard-admin/tambah-data-beasiswa', [beasiswaModelController::class, 'store']); // Route Untuk Proses Menyimpan Data Beasiswa Yang Ingin Di Tambah //
Route::get('/dashboard-admin/index-data-beasiswa/preview/{beasiswa}', [beasiswaModelController::class, 'show'])->name('previewBeasiswaPage'); // Route Untuk Menampilkan Informasi Beasiswa Yang di Pilih //
Route::get('/dashboard-admin/index-data-beasiswa/edit-data/{beasiswa}', [adminController::class, 'formEditingDataBeasiswa']); // Route Untuk Munuju Ke Form Update Informasi Beasiswa Yang di Pilih //
Route::put('/dashboard-admin/index-data-beasiswa/edit-data/{beasiswa}', [beasiswaModelController::class, 'update']); // Route Untuk Munuju Ke Form Update Informasi Beasiswa Yang di Pilih //
Route::delete('/dashboard-admin/index-data-beasiswa/deleting-data/{beasiswa}', [beasiswaModelController::class, 'destroy']); // Route Untuk Menghapus Informasi Beasiswa Yang di Pilih //

Route::get('/dashboard-admin/index-data-lomba', [adminController::class, 'indexTableLomba'])->name('indexTableDataLomba'); // Route Ke Dashbard Untuk Admin //
Route::get('/dashboard-admin/tambah-data-lomba', [adminController::class, 'formTambahDataLomba']); // Route Untuk Tambah Data Lomba //
Route::post('/dashboard-admin/tambah-data-lomba', [lombaController::class, 'store']); // Route Untuk Tambah Data Lomba //
Route::get('/dashboard-admin/index-data-lomba/preview/{lomba}', [lombaController::class, 'show'])->name('previewLombaPage'); // Route Untuk Menampilkan Informasi Lomba Yang di Pilih //
Route::get('/dashboard-admin/index-data-lomba/edit-data/{lomba}', [adminController::class, 'formEditingDataLomba']); // Route Untuk Munuju Ke Form Update Informasi Lomba Yang di Pilih //
Route::put('/dashboard-admin/index-data-lomba/edit-data/{lomba}', [lombaController::class, 'update']); // Route Untuk Proses Update Informasi Lomba Yang di Pilih //
Route::delete('/dashboard-admin/index-data-lomba/deleting-data/{lomba}', [lombaController::class, 'destroy']); // Route Untuk Menghapus Informasi Lomba Yang di Pilih //

Route::get('/dashboard-admin/index-data-prestasi-mahasiswa', [adminController::class, 'indexTablePrestasi'])->name('indexTableDataPrestasi'); // Route Ke Index Prestasi //
Route::get('/dashboard-admin/tambah-data-prestasi-mahasiswa', [adminController::class, 'formTambahDataPrestasi']); // Route Ke Form Tambah Data Prestasi //
Route::post('/dashboard-admin/tambah-data-prestasi-mahasiswa', [prestasiModelController::class, 'store']); // Route Ke Proses Tambah Data Prestasi //
Route::get('/dashboard-admin/index-data-prestasi-mahasiswa/preview/{nim}', [prestasiModelController::class, 'show']); // Route Ke Proses Tambah Data Prestasi //
Route::get('/dashboard-admin/index-data-prestasi-mahasiswa/edit-data/{mahasiswa_prestasi}', [adminController::class, 'formEditingDataPrestasi']); // Route Ke Form Editing Data Prestasi //
Route::post('/dashboard-admin/index-data-prestasi-mahasiswa/edit-data/{mahasiswa_prestasi}', [prestasiModelController::class, 'update']); // Route Ke Proses Updating Data Prestasi //

Route::get('/dashboard-admin/index-data-mahasiswa', [adminController::class, 'indexTableMahasiswa'])->name('indexTableDataMahasiswa'); // Route Ke Index Mahasiswa  //

Route::get('/dashboard-admin/my-profile', [adminController::class, 'profileAdmin'])->name('pageProfileAdmin'); // Route Ke Profil Admin //



Route::get('/beranda', [adminController::class, 'profileAdmin'])->name('pageBeranda'); // Route Ke Profil Admin //

