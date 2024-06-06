<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\StudentController;

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
// Homepage
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'storeStudent'])->name('register_student.store');
Route::get('/register/lecturer', [RegisterController::class, 'lecturer'])->name('register.lecturer');
Route::post('/register/lecturer', [RegisterController::class, 'storeLecturer'])->name('register_lecturer.store');

Route::middleware(['auth', 'dosen'])->group(function () {
    // Admin
    Route::get('/dashboard', [LecturerController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('lecture.profile');
    Route::get('/dashboard/profile/update/{id_dosen}', [LecturerController::class, 'getIdUser'])->name('edit.lecturer');
    Route::put('/dashboard/profile/update/{id_dosen}', [LecturerController::class, 'updateProfile'])->name('update.lecturer');

    // silabus
    Route::get('/dashboard/pembelajaran', [PembelajaranController::class, 'index'])->name('pembelajaran');
    Route::post('/dashboard/pembelajaran', [PembelajaranController::class, 'store_silabus'])->name('store_silabus');
    Route::put('/dashboard/pembelajaran/update/{id_silabus}', [PembelajaranController::class, 'update_silabus'])->name('update_silabus');
    Route::delete('/dashboard/pembelajaran/delete/{id_silabus}', [PembelajaranController::class, 'hapus_silabus'])->name('hapus_silabus');
    
    // silabus/komentar
    Route::post('/dashboard/pembelajaran/{id_silabus}', [PembelajaranController::class, 'tambah_komentar'])->name('tambah_komentar_pembelajarn');
    Route::delete('/dashboard/pembelajaran/{id_komentar}', [PembelajaranController::class, 'hapus_komentar'])->name('hapus_komentar');
    
    // materi
    Route::get('/dashboard/materi', [MateriController::class, 'index'])->name('materi');
    Route::post('/dashboard/materi', [MateriController::class, 'create'])->name('tambah_materi');
    Route::put('/dashboard/materi/{id_materi}', [MateriController::class, 'update'])->name('edit_materi');
    Route::delete('/dashboard/materi/{id_materi}', [MateriController::class, 'destroy'])->name('hapus_materi');
    // materi/komentar
    Route::post('/dashboard/materi/{id_materi}', [MateriController::class, 'tambah_komentar'])->name('tambah_komentar');
    Route::delete('/dashboard/materi/{id_komentar}', [MateriController::class, 'hapus_komentar'])->name('hapus_komentar');
    
    // mahasiswa
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::put('/dashboard/mahasiswa/{id_mahasiswa}', [MahasiswaController::class, 'update'])->name('update_mahasiswa');
    Route::delete('/dashboard/mahasiswa/hapus/{id_mahasiswa}', [MahasiswaController::class, 'destroy'])->name('hapus_mahasiswa');
    Route::post('/dashboard/mahasiswa/tugas/{id_tugas}', [MahasiswaController::class, 'store_tugas'])->name('store.tugas.mahasiswa');
    
    // Absensi
    Route::get('/dashboard/absensi',[AbsensiController::class, 'index'])->name('absensi');
    Route::get('/dashboard/absensi/tambah',[AbsensiController::class, 'tambah_absensi'])->name('tambah_absensi');
    Route::post('/dashboard/absensi/tambah',[AbsensiController::class, 'store'])->name('store_absensi');
    Route::put('/dashboard/absensi/terima/{id_absensi}',[AbsensiController::class, 'terima'])->name('terima_absensi');
    Route::put('/dashboard/absensi/tolak/{id_absensi}',[AbsensiController::class, 'tolak'])->name('tolak_absensi');
    
    // Rekap Tugas
    Route::get('/dashboard/rekap',[RekapController::class, 'index'])->name('rekap_tugas');
    Route::post('/dashboard/rekap',[RekapController::class, 'store'])->name('tambah_tugas');
    Route::put('/dashboard/rekap/{id_tugas}',[RekapController::class, 'update'])->name('edit_tugas');
    Route::delete('/dashboard/rekap/{id_tugas}',[RekapController::class, 'destroy'])->name('hapus_tugas');
    
    // Nilai
    Route::get('/dashboard/nilai',[NilaiController::class, 'index'])->name('nilai');
    Route::post('/dashboard/nilai/store',[NilaiController::class, 'store'])->name('store.rekapnilai');
    Route::put('/dashboard/nilai/update/{id_rekap_nilai}',[NilaiController::class, 'update'])->name('update.rekapnilai');
    Route::delete('/dashboard/nilai/delete/{id_rekap_nilai}',[NilaiController::class, 'destroy'])->name('delete.rekapnilai');
    Route::put('/dashboard/nilai/tugas/{id_nilai}',[NilaiController::class, 'update_nilai_tugas'])->name('update_nilai_tugas');
    // end of Admin
});

Route::get('/student_dashboard', [StudentController::class, 'index'])->name('student_dashboard');