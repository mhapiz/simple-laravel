<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\AdminSewaKamarController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/test', [AdminController::class, 'test'])->name('test');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::prefix('kamar')
            ->group(function () {
                Route::get('/', [AdminKamarController::class, 'index'])->name('admin.kamar.index');
                Route::get('/getData', [AdminKamarController::class, 'getData'])->name('admin.kamar.getData');

                Route::get('/tambah', [AdminKamarController::class, 'create'])->name('admin.kamar.create');
                Route::post('/store', [AdminKamarController::class, 'store'])->name('admin.kamar.store');

                Route::get('/edit/{id}', [AdminKamarController::class, 'edit'])->name('admin.kamar.edit');
                Route::put('/update/{id}', [AdminKamarController::class, 'update'])->name('admin.kamar.update');

                Route::delete('/delete/{id}', [AdminKamarController::class, 'delete'])->name('admin.kamar.delete');
            });

        Route::prefix('sewa-kamar')
            ->group(function () {
                Route::get('/', [AdminSewaKamarController::class, 'index'])->name('admin.sewa-kamar.index');
                Route::get('/getData', [AdminSewaKamarController::class, 'getData'])->name('admin.sewa-kamar.getData');

                Route::get('/tambah', [AdminSewaKamarController::class, 'create'])->name('admin.sewa-kamar.create');
                Route::post('/store', [AdminSewaKamarController::class, 'store'])->name('admin.sewa-kamar.store');

                Route::get('/edit/{id}', [AdminSewaKamarController::class, 'edit'])->name('admin.sewa-kamar.edit');
                Route::put('/update/{id}', [AdminSewaKamarController::class, 'update'])->name('admin.sewa-kamar.update');

                Route::get('/checkout-1/{id}', [AdminSewaKamarController::class, 'checkout1'])->name('admin.sewa-kamar.checkout1');
                Route::put('/checkout-1/{id}/store', [AdminSewaKamarController::class, 'storeCheckout1'])->name('admin.sewa-kamar.storeCheckout1');

                Route::get('/checkout-2/{id}', [AdminSewaKamarController::class, 'checkout2'])->name('admin.sewa-kamar.checkout2');
                Route::put('/checkout-2/{id}/store', [AdminSewaKamarController::class, 'storeCheckout2'])->name('admin.sewa-kamar.storeCheckout2');

                Route::get('/detail/{id}', [AdminSewaKamarController::class, 'detail'])->name('admin.sewa-kamar.detail');

                Route::delete('/delete/{id}', [AdminSewaKamarController::class, 'delete'])->name('admin.sewa-kamar.delete');
            });
    });
