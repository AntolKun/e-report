<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

//admin controller start
Route::get('/adminDashboard', [AdminController::class, 'index'])->name('adminDashboard');

Route::get('/admin/tambahAdmin', [AdminController::class, 'tambahAdmin'])->name('tambahAdmin');

Route::get('/admin/buatAdmin', [AdminController::class, 'create'])->name('buatAdmin');

Route::post('/admin/buatAdminStore', [AdminController::class, 'store'])->name('buatAdminStore');

