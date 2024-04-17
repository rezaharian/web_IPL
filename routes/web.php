<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\laporan\lprPembayaran;
use App\Http\Controllers\admin\masterJenIyuranController;
use App\Http\Controllers\admin\masterPembayaranIyuran;
use App\Http\Controllers\admin\masterUserController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\masterJenPembayaranController;
use App\Http\Controllers\user\dashboardController as UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EncryptId;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// contoh rute untuk admin
Route::group(['middleware' => ['auth', 'CheckRole:admin',]], function () {
    // LOG
    Route::get('/admin/dashboard/log_user_login', [masterUserController::class, 'log_user_login'])->name('log_user_login');
    Route::get('/admin/dashboard', [dashboardController::class, 'index'])->name('admin.index');
    // master (user)
    Route::get('/admin/dashboard/masterUser', [masterUserController::class, 'index'])->name('admin.masteruser.index');
    Route::get('/admin/dashboard/masterUserCreate', [masterUserController::class, 'create'])->name('admin.masteruser.create');
    Route::post('/admin/dashboard/masterUserStore', [masterUserController::class, 'store'])->name('admin.masteruser.store');
    Route::get('/admin/dashboard/masterUserEdit/{encryptedId}', [masterUserController::class, 'edit'])->name('admin.masteruser.edit');
    Route::put('/admin/dashboard/masterUserUpdate/{encryptedId}', [masterUserController::class, 'update'])->name('admin.masteruser.update');

    Route::delete('/admin/dashboard/masterUserDestroy/{encryptedId}', [masterUserController::class, 'destroy'])->name('admin.masteruser.destroy');
    // master (jenis iyuran)
    Route::get('/admin/dashboard/masterJenIyuran', [masterJenIyuranController::class, 'index'])->name('admin.masterJenIyuran.index');
    Route::get('/admin/dashboard/masterJenIyuranCreate', [masterJenIyuranController::class, 'create'])->name('admin.masterJenIyuran.create');
    Route::post('/admin/dashboard/masterJenIyuranStore', [masterJenIyuranController::class, 'store'])->name('admin.masterJenIyuran.store');
    Route::get('/admin/dashboard/masterJenIyuranEdit/{id}', [masterJenIyuranController::class, 'edit'])->name('admin.masterJenIyuran.edit');
    Route::put('/admin/dashboard/masterJenIyuranUpdate/{id}', [masterJenIyuranController::class, 'update'])->name('admin.masterJenIyuran.update');
    Route::delete('/admin/dashboard/masterJenIyuranDestroy/{id}', [masterJenIyuranController::class, 'destroy'])->name('admin.masterJenIyuran.destroy');
    // master (Pembayaran iyuran)
    Route::get('/admin/dashboard/masterPembayaranIyuran', [masterPembayaranIyuran::class, 'index'])->name('admin.masterPembayaranIyuran.index');
    Route::get('/admin/dashboard/admin/dashboard/masterPembayaranIyuranCreate', [masterPembayaranIyuran::class, 'create'])->name('admin.masterPembayaranIyuran.create');
    Route::post('/admin/dashboard/admin/dashboard/masterPembayaranIyuranStore', [masterPembayaranIyuran::class, 'store'])->name('admin.masterPembayaranIyuran.store');
    Route::get('/admin/dashboard/admin/dashboard/masterPembayaranIyuranEdit/{id}', [masterPembayaranIyuran::class, 'edit'])->name('admin.masterPembayaranIyuran.edit');
    Route::put('/admin/dashboard/admin/dashboard/masterPembayaranIyuranUpdate/{id}', [masterPembayaranIyuran::class, 'update'])->name('admin.masterPembayaranIyuran.update');
    Route::delete('/admin/dashboard/admin/dashboard/masterPembayaranIyuranDestroy/{id}', [masterPembayaranIyuran::class, 'destroy'])->name('admin.masterPembayaranIyuran.destroy');
    // LAPORAN
    Route::get('/admin/dashboard/laporan/pembayaran/index', [lprPembayaran::class, 'index'])->name('admin.laporan.pembayaran.index');
    Route::get('/admin/dashboard/laporan/pembayaran/jenis/{jenisid}', [lprPembayaran::class, 'jenis'])->name('admin.laporan.pembayaran.jenis');
});

// contoh rute untuk user
Route::group(['middleware' => ['auth', 'CheckRole:user']], function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.index');
});
