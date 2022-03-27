<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminPengumumanController;
use App\Http\Controllers\API\JadwalSholatController;
use App\Http\Controllers\API\PengajianController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InfaqController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\LaporanKeuanganController;
use App\Http\Controllers\API\UangKeluarController;
use App\Http\Controllers\API\UangMasukController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

//admin
Route::post('admin/register', [AuthController::class, 'registerAdmin']);
Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');

//user
Route::post('user/register', [AuthController::class, 'registerUser']);
Route::post('user/login', [AuthController::class, 'adminLogin'])->name('adminLogin');


// Route::get('/infaq', [InfaqController::class, 'index'])->middleware('auth:user-api');
// Route::post('/infaq', [InfaqController::class, 'store'])->middleware('auth:user-api');
// Route::post('/infaq/notification', [InfaqController::class, 'notificationHandler']);






Route::middleware('auth:admin-api')->get('currentAdmin', [AuthController::class, 'currentAdmin']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin-api', 'scopes:admin']], function () {

   //Laporan Uang masuk
   Route::post('/uangmasuk', [LaporanKeuanganController::class, 'UangMasuk']);

   //laporan uang masuk
   Route::post('/uang_masuk', [UangMasukController::class, 'store']);
   Route::post('/uang_masuk/{id}', [UangMasukController::class, 'update']);
   Route::get('/uang_masuk/detail/{id}', [UangMasukController::class, 'showdata']);
   Route::get('/uang_masuk', [UangMasukController::class, 'index']);
   Route::post('/uang_masuk/filter', [UangMasukController::class, 'show']);
   Route::delete('/uang_masuk/{id}', [UangMasukController::class, 'destroy']);
   Route::get('/uang_masuk/jumlah', [UangMasukController::class, 'SumUangMasuk']);

   //laporan uang keluar
   Route::post('/uang_keluar', [UangKeluarController::class, 'store']);
   Route::post('/uang_keluar/{id}', [UangKeluarController::class, 'update']);
   Route::get('/uang_keluar/detail/{id}', [UangKeluarController::class, 'showdata']);
   Route::get('/uang_keluar', [UangKeluarController::class, 'index']);
   Route::post('/uang_keluar/filter', [UangKeluarController::class, 'show']);
   Route::delete('/uang_keluar/{id}', [UangKeluarController::class, 'destroy']);
   Route::get('/uang_keluar/jumlah', [UangKeluarController::class, 'SumUangKeluar']);


   //pengumuman
   Route::post('/pengumuman', [AdminPengumumanController::class, 'store']);
   Route::post('/pengumuman/{id}', [AdminPengumumanController::class, 'update']);
   Route::get('/pengumuman', [AdminPengumumanController::class, 'index']);
   Route::get('/pengumuman/{id}', [AdminPengumumanController::class, 'show']);
   Route::delete('/pengumuman/{id}', [AdminPengumumanController::class, 'destroy']);


   //pengajian
   Route::post('/pengajian', [PengajianController::class, 'store']);
   Route::post('/pengajian/{id}', [PengajianController::class, 'update']);
   Route::get('/pengajian', [PengajianController::class, 'index']);
   Route::get('/pengajian/{id}', [PengajianController::class, 'show']);
   Route::delete('/pengajian/{id}', [PengajianController::class, 'destroy']);


   //jadwal sholat
   Route::post('/sholat', [JadwalSholatController::class, 'store']);
   Route::post('/sholat/{id}', [JadwalSholatController::class, 'update']);
   Route::get('/sholat', [JadwalSholatController::class, 'index']);
   Route::get('/sholat1', [JadwalSholatController::class, 'index1']);
   Route::get('/sholat/{id}', [JadwalSholatController::class, 'show']);
   Route::delete('/sholat/{id}', [JadwalSholatController::class, 'destroy']);


   //Infaq
   Route::get('/infaq', [InfaqController::class, 'GetAdmin']);
   Route::get('/infaq/total', [InfaqController::class, 'SumInfaq']);
});


Route::group(['prefix' => 'user', 'middleware' => ['auth:user-api']], function () {
   //infaq
   Route::get('/infaq', [InfaqController::class, 'index']);
   Route::post('/infaq', [InfaqController::class, 'store']);
   Route::post('/infaq/notification', [InfaqController::class, 'notificationHandler']);

   //profile

   Route::post('/profil', [ProfileController::class, 'update']);
   Route::get('/profile', [ProfileController::class, 'index']);
   Route::post('/profile/password', [ProfileController::class, 'updatePassword']);
});

Route::get('/pengajian/user', [PengajianController::class, 'index']);
