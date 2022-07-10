<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/lot/{url}', [LotController::class, 'index'])->name('lot');
Route::post('/lot/bet', [LotController::class, 'userBet'])->middleware(['auth'])->name('lot.bet');

Route::prefix('account')->controller(AccountController::class)->middleware(['auth'])->group(function() {
    Route::get('/', 'index')->name('account');
    Route::post('/update-user', 'updateUser')->name('account.update_user');

    Route::post('/add-lot', 'addLot')->name('account.add_lot');
    Route::post('/update-lot', 'updateLot')->name('account.update_lot');
    Route::get('/delete-lot/{id}', 'deleteLot')->name('account.delete_lot');
});

Route::prefix('admin')->controller(AdminController::class)->group(function() {
    Route::get('/', 'index')->name('admin');
    Route::get('/login', 'loginShow')->middleware(['guest:admin'])->name('admin.login_show');
    Route::post('/login', 'login')->middleware(['guest:admin'])->name('admin.login');
    Route::get('/logout', 'logout')->middleware(['auth:admin'])->name('admin.logout');

    Route::post('/add_category', 'addCategory')->middleware(['auth:admin'])->name('admin.add_category');
    Route::get('/delete-cat/{id}', 'deleteCategory')->middleware(['auth:admin'])->name('admin.delete_category');
    Route::get('/delete-user/{id}', 'deleteUser')->middleware(['auth:admin'])->name('admin.delete_user');
});

require __DIR__.'/auth.php';
