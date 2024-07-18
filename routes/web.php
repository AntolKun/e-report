<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGuruController;

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

Route::get('/admin/dataAdmin', [AdminController::class, 'dataAdmin'])->name('dataAdmin');

Route::get('/admin/buatAdmin', [AdminController::class, 'create'])->name('buatAdmin');

Route::post('/admin/add', [AdminController::class, 'store'])->name('buatAdminStore');

Route::delete('/admin/hapus{id}', [AdminController::class, 'destroy'])->name('hapusAdmin');

Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('editAdmin');

Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('updateAdmin');


Route::get('/guru/dataGuru', [AdminGuruController::class, 'index'])->name('dataGuru');

Route::get('/guru/buatGuru', [AdminGuruController::class, 'create'])->name('buatGuru');

Route::post('/guru/add', [AdminGuruController::class, 'store'])->name('buatGuruStore');

Route::delete('/guru/hapus/{id}', [AdminGuruController::class, 'destroy'])->name('hapusGuru');

Route::get('/guru/edit/{id}', [AdminGuruController::class, 'edit'])->name('editGuru');

Route::put('/guru/update/{id}', [AdminGuruController::class, 'update'])->name('updateGuru');

Route::get('/guru/show/{guru}', [AdminGuruController::class, 'show'])->name('showGuru');



