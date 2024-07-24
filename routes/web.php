<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AudiometriController;
use App\Http\Controllers\SpirometriController;

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

Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');

Route::get('/surat/{pasien}/audiometri', [AudiometriController::class, 'index'])->name('audiometri.index');
Route::get('/surat/{pasien}/audiometri/create', [AudiometriController::class, 'create'])->name('audiometri.create');
Route::post('/audiometri', [AudiometriController::class, 'store'])->name('audiometri.store');
Route::get('/surat/audiometri/{audiometri}', [AudiometriController::class, 'show'])->name('audiometri.show');
Route::get('/surat/audiometri/{audiometri}/edit', [AudiometriController::class, 'edit'])->name('audiometri.edit');
Route::put('/audiometri/{audiometri}', [AudiometriController::class, 'update'])->name('audiometri.update');
Route::delete('/audiometri/{id}', [AudiometriController::class, 'destroy'])->name('audiometri.destroy');
Route::post('/audiometri/generate/{audiometri}', [AudiometriController::class, 'generate'])->name('audiometri.generate');

Route::get('/surat/{pasien}/spirometri', [SpirometriController::class, 'index'])->name('spirometri.index');
Route::get('/surat/{pasien}/spirometri/create', [SpirometriController::class, 'create'])->name('spirometri.create');
Route::post('/spirometri', [SpirometriController::class, 'store'])->name('spirometri.store');
Route::get('/surat/spirometri/{spirometri}', [SpirometriController::class, 'show'])->name('spirometri.show');
// Route::get('/surat/audiometri/{audiometri}/edit', [AudiometriController::class, 'edit'])->name('audiometri.edit');
// Route::put('/audiometri/{audiometri}', [AudiometriController::class, 'update'])->name('audiometri.update');
// Route::delete('/audiometri/{id}', [AudiometriController::class, 'destroy'])->name('audiometri.destroy');
// Route::post('/audiometri/generate/{audiometri}', [AudiometriController::class, 'generate'])->name('audiometri.generate');

// Route::get('/buat-surat/{pasien}/audiometri', [SuratController::class, 'dataAudiometri']);
// Route::get('/cetak-data/{audiometri}', [SuratController::class, 'cetakData']);
// Route::get('tambah-data-audiometri/{pasien}', [SuratController::class, 'tambahDataAudiometri']);
// Route::get('data-audiometri/{audiometri}', [SuratController::class, 'dataAudiometri']);
// Route::post('/generate/audiometri', [SuratController::class, 'audiometri']);