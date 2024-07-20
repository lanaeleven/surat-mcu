<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PasienController;

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
Route::get('/test', [SuratController::class, 'test']);

Route::get('/', [PasienController::class, 'create']);
Route::get('/tambah-pasien', [PasienController::class, 'tambahPasien']);
Route::get('/edit/{pasien}', [PasienController::class, 'edit']);
Route::get('/buat-surat/{pasien}', [PasienController::class, 'buatSurat']);
Route::get('/buat-surat/{pasien}/audiometri', [SuratController::class, 'dataAudiometri']);
Route::get('/cetak-data/{audiometri}', [SuratController::class, 'cetakData']);
Route::post('/tambah-pasien', [PasienController::class, 'store']);
Route::post('/generate/audiometri', [SuratController::class, 'audiometri']);