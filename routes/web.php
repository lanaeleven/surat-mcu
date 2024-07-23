<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AudiometriController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/t', function () {
    return view('template.vaksinasi');
});
// Route::get('/test', [SuratController::class, 'test']);

Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
Route::get('/surat/{pasien}', [PasienController::class, 'indexSurat'])->name('surat.index');

Route::get('/surat/{pasien}/audiometri', [AudiometriController::class, 'index'])->name('audiometri.index');
Route::get('/surat/{pasien}/audiometri/create', [AudiometriController::class, 'create'])->name('audiometri.create');
Route::post('/audiometri', [AudiometriController::class, 'store'])->name('audiometri.store');
Route::get('/surat/audiometri/{audiometri}', [AudiometriController::class, 'show'])->name('audiometri.show');
Route::get('/surat/audiometri/{audiometri}/edit', [AudiometriController::class, 'edit'])->name('audiometri.edit');
Route::put('/audiometri/{audiometri}', [AudiometriController::class, 'update'])->name('audiometri.update');
Route::post('/audiometri/generate/{audiometri}', [AudiometriController::class, 'generate'])->name('audiometri.generate');

// Route::get('/buat-surat/{pasien}/audiometri', [SuratController::class, 'dataAudiometri']);
// Route::get('/cetak-data/{audiometri}', [SuratController::class, 'cetakData']);
// Route::get('tambah-data-audiometri/{pasien}', [SuratController::class, 'tambahDataAudiometri']);
// Route::get('data-audiometri/{audiometri}', [SuratController::class, 'dataAudiometri']);
// Route::post('/generate/audiometri', [SuratController::class, 'audiometri']);