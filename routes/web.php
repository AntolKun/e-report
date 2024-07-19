<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminTahunAjaranController;
use App\Http\Controllers\AdminKelasController;

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

//data admin
Route::get('/admin/dataAdmin', [AdminController::class, 'dataAdmin'])->name('dataAdmin');
Route::get('/admin/buatAdmin', [AdminController::class, 'create'])->name('buatAdmin');
Route::post('/admin/add', [AdminController::class, 'store'])->name('buatAdminStore');
Route::delete('/admin/hapus{id}', [AdminController::class, 'destroy'])->name('hapusAdmin');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('editAdmin');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('updateAdmin');

//data guru
Route::get('/guru/dataGuru', [AdminGuruController::class, 'index'])->name('dataGuru');
Route::get('/guru/buatGuru', [AdminGuruController::class, 'create'])->name('buatGuru');
Route::post('/guru/add', [AdminGuruController::class, 'store'])->name('buatGuruStore');
Route::delete('/guru/hapus/{id}', [AdminGuruController::class, 'destroy'])->name('hapusGuru');
Route::get('/guru/edit/{id}', [AdminGuruController::class, 'edit'])->name('editGuru');
Route::put('/guru/update/{id}', [AdminGuruController::class, 'update'])->name('updateGuru');
Route::get('/guru/show/{guru}', [AdminGuruController::class, 'show'])->name('showGuru');

//data siswa
Route::get('/siswa/dataSiswa', [AdminSiswaController::class, 'index'])->name('dataSiswa');
Route::get('/siswa/buatSiswa', [AdminSiswaController::class, 'create'])->name('buatSiswa');
Route::post('/siswa/add', [AdminSiswaController::class, 'store'])->name('buatSiswaStore');
Route::delete('/siswa/hapus/{id}', [AdminSiswaController::class, 'destroy'])->name('hapusSiswa');
Route::get('/siswa/edit/{id}', [AdminSiswaController::class, 'edit'])->name('editSiswa');
Route::put('/siswa/update/{id}', [AdminSiswaController::class, 'update'])->name('updateSiswa');
Route::get('/siswa/show/{siswa}', [AdminSiswaController::class, 'show'])->name('showSiswa');

//data tahun ajaran
Route::get('/tahun/dataTahunAjaran', [AdminTahunAjaranController::class, 'index'])->name('dataTahunAjaran');
Route::get('/tahun/buatTahunAjaran', [AdminTahunAjaranController::class, 'create'])->name('buatTahunAjaran');
Route::post('/tahun/add', [AdminTahunAjaranController::class, 'store'])->name('buatTahunAjaranStore');
Route::delete('/tahun/hapus/{id}', [AdminTahunAjaranController::class, 'destroy'])->name('hapusTahunAjaran');
Route::get('/tahun/edit/{id}', [AdminTahunAjaranController::class, 'edit'])->name('editTahunAjaran');
Route::put('/tahun/update/{id}', [AdminTahunAjaranController::class, 'update'])->name('updateTahunAjaran');

//data kelas
Route::get('/kelas/dataKelas', [AdminKelasController::class, 'index'])->name('dataKelas');
