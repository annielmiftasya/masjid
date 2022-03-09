<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminPengumumanController;
use App\Http\Controllers\API\JadwalSholatController;
use App\Http\Controllers\API\PengajianController;
use App\Http\Controllers\API\AuthController;

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





//jadwal sholat
Route::post('/sholat', [JadwalSholatController::class, 'store']);
Route::post('/sholat/{id}', [JadwalSholatController::class, 'update']);
Route::get('/sholat', [JadwalSholatController::class, 'index']);
Route::get('/sholat/{id}', [JadwalSholatController::class, 'show']);
Route::delete('/sholat/{id}', [JadwalSholatController::class, 'destroy']);

//pengajian
Route::post('/pengajian', [PengajianController::class, 'store']);
Route::post('/pengajian/{id}', [PengajianController::class, 'update']);
Route::get('/pengajian', [PengajianController::class, 'index']);
Route::get('/pengajian/{id}', [PengajianController::class, 'show']);
Route::delete('/pengajian/{id}', [PengajianController::class, 'destroy']);

Route::middleware('auth:admin-api')->get('currentAdmin', [AuthController::class, 'currentAdmin']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin-api', 'scopes:admin']], function () {

   //pengumuman
   Route::post('/pengumuman', [AdminPengumumanController::class, 'store']);
   Route::post('/pengumuman/{id}', [AdminPengumumanController::class, 'update']);
   Route::get('/pengumuman', [AdminPengumumanController::class, 'index']);
   Route::get('/pengumuman/{id}', [AdminPengumumanController::class, 'show']);
   Route::delete('/pengumuman/{id}', [AdminPengumumanController::class, 'destroy']);
});
