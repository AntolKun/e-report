<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminTahunAjaranController;
use App\Http\Controllers\AdminKelasController;
use App\Http\Controllers\AdminKelasSiswaController;
use App\Http\Controllers\KelasGuruController;
use App\Http\Controllers\DimensiController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\FileController;


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


Route::get('/404', function () {
    return view('404');
});


Route::get('/login', function () {
    return view('auth.Login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['role:admin'])->group(function () {
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
    Route::get('/kelas/buatKelas', [AdminKelasController::class, 'create'])->name('buatKelas');
    Route::post('/kelas/add', [AdminKelasController::class, 'store'])->name('buatKelasStore');
    Route::get('/kelas/edit/{id}', [AdminKelasController::class, 'edit'])->name('editKelas');
    Route::put('/kelas/update/{id}', [AdminKelasController::class, 'update'])->name('updateKelas');
    Route::delete('/kelas/hapus/{id}', [AdminKelasController::class, 'destroy'])->name('hapusKelas');

    //data kelas siswa
    // Route::prefix('kelas/{kelas}')->group(function () {
    //     Route::get('siswa', [AdminKelasSiswaController::class, 'index'])->name('dataKelasSiswa');
    //     Route::post('siswa', [AdminKelasSiswaController::class, 'store'])->name('simpanKelasSiswa');
    //     Route::delete('siswa/{id}', [AdminKelasSiswaController::class, 'destroy'])->name('hapusKelasSiswa');
    // });
    Route::get('/kelas/{kelas}/dataKelas', [AdminKelasSiswaController::class, 'index'])->name('dataKelasSiswa');
    Route::post('/kelas/{kelas}/assign', [AdminKelasSiswaController::class, 'store'])->name('simpanKelasSiswa');
    Route::delete('/kelas/{kelas}/remove/{id}', [AdminKelasSiswaController::class, 'destroy'])->name('hapusKelasSiswa');
});

Route::middleware(['role:guru'])->group(function () {
    Route::get('/guru/classes', [KelasGuruController::class, 'myClasses'])->name('guru.classes');
    Route::get('/guru/kelas/{id}/detail', [KelasGuruController::class, 'show'])->name('guru.kelas.detail');

    Route::get('/dimensi', [DimensiController::class, 'index'])->name('DataDimensi');
    Route::get('/dimensi/create', [DimensiController::class, 'create'])->name('dimensi.create');
    Route::post('/dimensi', [DimensiController::class, 'store'])->name('dimensi.store');
    Route::get('/dimensi/{dimensi}/edit', [DimensiController::class, 'edit'])->name('dimensi.edit');
    Route::put('/dimensi/{dimensi}', [DimensiController::class, 'update'])->name('dimensi.update');
    Route::delete('/dimensi/{dimensi}', [DimensiController::class, 'destroy'])->name('dimensi.destroy');


    Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
    Route::get('/proyek/create', [ProyekController::class, 'create'])->name('proyek.create');
    Route::post('/proyek', [ProyekController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/{proyek}/edit', [ProyekController::class, 'edit'])->name('proyek.edit');
    Route::put('/proyek/{proyek}', [ProyekController::class, 'update'])->name('proyek.update');
    Route::delete('/proyek/{proyek}', [ProyekController::class, 'destroy'])->name('proyek.destroy');
    Route::get('/proyek/{proyek}/siswa', [ProyekController::class, 'showSiswa'])->name('proyek.showSiswa');

    //
    Route::get('/proyek/{id}', [ProyekController::class, 'show'])->name('proyek.show');
    Route::get('/proyek/{proyek}/siswa', [ProyekController::class, 'getSiswa'])->name('proyek.siswa');
    Route::get('/guru/proyek/{id}/download/{fileName}', [ProyekController::class, 'downloadFile'])->name('guru.proyek.download');
    Route::post('/proyek_siswa/{id}/keterangan', [ProyekController::class, 'updateKeterangan'])->name('proyek_siswa.update_keterangan');
    Route::post('/guru/proyek/{id}/keterangan', [ProyekController::class, 'saveKeterangan'])->name('guru.proyek.saveKeterangan');

});

Route::middleware(['role:siswa'])->group(function () {
    Route::get('/siswa/kelas', [SiswaController::class, 'myClasses'])->name('siswa.kelas');
    Route::get('/siswa/kelas/{id}', [SiswaController::class, 'detail'])->name('siswa.kelas.detail');
    Route::get('/siswa/proyek/{id}', [SiswaController::class, 'proyekDetail'])->name('siswa.proyek.detail');
    Route::get('/siswa/proyek/{id}/submit', [SiswaController::class, 'submitWorkForm'])->name('siswa.proyek.submit');
    Route::post('/siswa/proyek/{id}/submit', [SiswaController::class, 'submitWork'])
        ->middleware('auth')
        ->name('siswa.proyek.submit.post');
    Route::get('/siswa/proyek/{id}/download/{fileName}', [SiswaController::class, 'downloadFile'])->name('siswa.proyek.download');
});
