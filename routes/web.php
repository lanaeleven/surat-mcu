<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigiController;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\NarkotikaController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TreadmillController;
use App\Http\Controllers\VaksinasiController;
use App\Http\Controllers\AudiometriController;
use App\Http\Controllers\SpirometriController;
use App\Http\Controllers\MedicalReportController;
use App\Http\Controllers\KesehatanBadanController;
use App\Http\Controllers\TuberkulosisController;

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
    $pdf = Pdf::loadView('template-surat.gigi');
    return $pdf->stream();
});
// Route::get('/test', [SuratController::class, 'test']);


Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->name('user.authenticate');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/', [PasienController::class, 'index'])->name('pasien.index')->middleware('auth');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create')->middleware('auth');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit')->middleware('auth');
Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
Route::get('/surat/{pasien}', [PasienController::class, 'indexSurat'])->name('surat.index')->middleware('auth');

Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index')->middleware('auth');
Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create')->middleware('auth');
Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit')->middleware('auth');
Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');

Route::get('/surat/{pasien}/audiometri', [AudiometriController::class, 'index'])->name('audiometri.index')->middleware('auth');
Route::get('/surat/{pasien}/audiometri/create', [AudiometriController::class, 'create'])->name('audiometri.create')->middleware('auth');
Route::post('/audiometri', [AudiometriController::class, 'store'])->name('audiometri.store');
Route::get('/surat/audiometri/{audiometri}', [AudiometriController::class, 'show'])->name('audiometri.show')->middleware('auth');
Route::get('/surat/audiometri/{audiometri}/edit', [AudiometriController::class, 'edit'])->name('audiometri.edit')->middleware('auth');
Route::put('/audiometri/{audiometri}', [AudiometriController::class, 'update'])->name('audiometri.update');
Route::delete('/audiometri/{id}', [AudiometriController::class, 'destroy'])->name('audiometri.destroy');
Route::post('/audiometri/generate/{audiometri}', [AudiometriController::class, 'generate'])->name('audiometri.generate');

Route::get('/surat/{pasien}/spirometri', [SpirometriController::class, 'index'])->name('spirometri.index')->middleware('auth');
Route::get('/surat/{pasien}/spirometri/create', [SpirometriController::class, 'create'])->name('spirometri.create')->middleware('auth');
Route::post('/spirometri', [SpirometriController::class, 'store'])->name('spirometri.store');
Route::get('/surat/spirometri/{spirometri}', [SpirometriController::class, 'show'])->name('spirometri.show')->middleware('auth');
Route::get('/surat/spirometri/{spirometri}/edit', [SpirometriController::class, 'edit'])->name('spirometri.edit')->middleware('auth');
Route::put('/spirometri/{spirometri}', [SpirometriController::class, 'update'])->name('spirometri.update');
Route::delete('/spirometri/{id}', [SpirometriController::class, 'destroy'])->name('spirometri.destroy');
Route::post('/spirometri/generate/{spirometri}', [SpirometriController::class, 'generate'])->name('spirometri.generate');

Route::get('/surat/{pasien}/vaksinasi', [VaksinasiController::class, 'index'])->name('vaksinasi.index')->middleware('auth');
Route::get('/surat/{pasien}/vaksinasi/create', [VaksinasiController::class, 'create'])->name('vaksinasi.create')->middleware('auth');
Route::post('/vaksinasi', [VaksinasiController::class, 'store'])->name('vaksinasi.store');
Route::get('/surat/vaksinasi/{vaksinasi}', [VaksinasiController::class, 'show'])->name('vaksinasi.show')->middleware('auth');
Route::get('/surat/vaksinasi/{vaksinasi}/edit', [VaksinasiController::class, 'edit'])->name('vaksinasi.edit')->middleware('auth');
Route::put('/vaksinasi/{vaksinasi}', [VaksinasiController::class, 'update'])->name('vaksinasi.update');
Route::delete('/vaksinasi/{id}', [VaksinasiController::class, 'destroy'])->name('vaksinasi.destroy');
Route::post('/vaksinasi/generate/{vaksinasi}', [VaksinasiController::class, 'generate'])->name('vaksinasi.generate');

Route::get('/surat/{pasien}/gizi', [GiziController::class, 'index'])->name('gizi.index')->middleware('auth');
Route::get('/surat/{pasien}/gizi/create', [GiziController::class, 'create'])->name('gizi.create')->middleware('auth');
Route::post('/gizi', [GiziController::class, 'store'])->name('gizi.store');
Route::get('/surat/gizi/{gizi}', [GiziController::class, 'show'])->name('gizi.show')->middleware('auth');
Route::get('/surat/gizi/{gizi}/edit', [GiziController::class, 'edit'])->name('gizi.edit')->middleware('auth');
Route::put('/gizi/{gizi}', [GiziController::class, 'update'])->name('gizi.update');
Route::delete('/gizi/{id}', [GiziController::class, 'destroy'])->name('gizi.destroy');
Route::post('/gizi/generate/{gizi}', [GiziController::class, 'generate'])->name('gizi.generate');

Route::get('/surat/{pasien}/medicalReport', [MedicalReportController::class, 'index'])->name('medicalReport.index')->middleware('auth');
Route::get('/surat/{pasien}/medicalReport/create', [MedicalReportController::class, 'create'])->name('medicalReport.create')->middleware('auth');
Route::post('/medicalReport', [MedicalReportController::class, 'store'])->name('medicalReport.store');
Route::get('/surat/medicalReport/{medicalReport}', [MedicalReportController::class, 'show'])->name('medicalReport.show')->middleware('auth');
Route::get('/surat/medicalReport/{medicalReport}/edit', [MedicalReportController::class, 'edit'])->name('medicalReport.edit')->middleware('auth');
Route::put('/medicalReport/{medicalReport}', [MedicalReportController::class, 'update'])->name('medicalReport.update');
Route::delete('/medicalReport/{id}', [MedicalReportController::class, 'destroy'])->name('medicalReport.destroy');
Route::post('/medicalReport/generate/{medicalReport}', [MedicalReportController::class, 'generate'])->name('medicalReport.generate');

Route::get('/surat/{pasien}/screening', [ScreeningController::class, 'index'])->name('screening.index')->middleware('auth');
Route::get('/surat/{pasien}/screening/create', [ScreeningController::class, 'create'])->name('screening.create')->middleware('auth');
Route::post('/screening', [ScreeningController::class, 'store'])->name('screening.store');
Route::get('/surat/screening/{screening}', [ScreeningController::class, 'show'])->name('screening.show')->middleware('auth');
Route::get('/surat/screening/{screening}/edit', [ScreeningController::class, 'edit'])->name('screening.edit')->middleware('auth');
Route::put('/screening/{screening}', [ScreeningController::class, 'update'])->name('screening.update');
Route::delete('/screening/{id}', [ScreeningController::class, 'destroy'])->name('screening.destroy');
Route::post('/screening/generate/{screening}', [ScreeningController::class, 'generate'])->name('screening.generate');

Route::get('/surat/{pasien}/kesehatanBadan', [KesehatanBadanController::class, 'index'])->name('kesehatanBadan.index')->middleware('auth');
Route::get('/surat/{pasien}/kesehatanBadan/create', [KesehatanBadanController::class, 'create'])->name('kesehatanBadan.create')->middleware('auth');
Route::post('/kesehatanBadan', [KesehatanBadanController::class, 'store'])->name('kesehatanBadan.store');
Route::get('/surat/kesehatanBadan/{kesehatanBadan}', [KesehatanBadanController::class, 'show'])->name('kesehatanBadan.show')->middleware('auth');
Route::get('/surat/kesehatanBadan/{kesehatanBadan}/edit', [KesehatanBadanController::class, 'edit'])->name('kesehatanBadan.edit')->middleware('auth');
Route::put('/kesehatanBadan/{kesehatanBadan}', [KesehatanBadanController::class, 'update'])->name('kesehatanBadan.update');
Route::delete('/kesehatanBadan/{id}', [KesehatanBadanController::class, 'destroy'])->name('kesehatanBadan.destroy');
Route::post('/kesehatanBadan/generate/{kesehatanBadan}', [KesehatanBadanController::class, 'generate'])->name('kesehatanBadan.generate');

Route::get('/surat/{pasien}/narkotika', [NarkotikaController::class, 'index'])->name('narkotika.index')->middleware('auth');
Route::get('/surat/{pasien}/narkotika/create', [NarkotikaController::class, 'create'])->name('narkotika.create')->middleware('auth');
Route::post('/narkotika', [NarkotikaController::class, 'store'])->name('narkotika.store');
Route::get('/surat/narkotika/{narkotika}', [NarkotikaController::class, 'show'])->name('narkotika.show')->middleware('auth');
Route::get('/surat/narkotika/{narkotika}/edit', [NarkotikaController::class, 'edit'])->name('narkotika.edit')->middleware('auth');
Route::put('/narkotika/{narkotika}', [NarkotikaController::class, 'update'])->name('narkotika.update');
Route::delete('/narkotika/{id}', [NarkotikaController::class, 'destroy'])->name('narkotika.destroy');
Route::post('/narkotika/generate/{narkotika}', [NarkotikaController::class, 'generate'])->name('narkotika.generate');

Route::get('/surat/{pasien}/treadmill', [TreadmillController::class, 'index'])->name('treadmill.index')->middleware('auth');
Route::get('/surat/{pasien}/treadmill/create', [TreadmillController::class, 'create'])->name('treadmill.create')->middleware('auth');
Route::post('/treadmill', [TreadmillController::class, 'store'])->name('treadmill.store');
Route::get('/surat/treadmill/{treadmill}', [TreadmillController::class, 'show'])->name('treadmill.show')->middleware('auth');
Route::get('/surat/treadmill/{treadmill}/edit', [TreadmillController::class, 'edit'])->name('treadmill.edit')->middleware('auth');
Route::put('/treadmill/{treadmill}', [TreadmillController::class, 'update'])->name('treadmill.update');
Route::delete('/treadmill/{id}', [TreadmillController::class, 'destroy'])->name('treadmill.destroy');
Route::post('/treadmill/generate/{treadmill}', [TreadmillController::class, 'generate'])->name('treadmill.generate');

Route::get('/surat/{pasien}/gigi', [GigiController::class, 'index'])->name('gigi.index')->middleware('auth');
Route::get('/surat/{pasien}/gigi/create', [GigiController::class, 'create'])->name('gigi.create')->middleware('auth');
Route::post('/gigi', [GigiController::class, 'store'])->name('gigi.store');
Route::get('/surat/gigi/{gigi}', [GigiController::class, 'show'])->name('gigi.show')->middleware('auth');
Route::get('/surat/gigi/{gigi}/edit', [GigiController::class, 'edit'])->name('gigi.edit')->middleware('auth');
Route::put('/gigi/{gigi}', [GigiController::class, 'update'])->name('gigi.update');
Route::delete('/gigi/{id}', [GigiController::class, 'destroy'])->name('gigi.destroy');
Route::post('/gigi/generate/{gigi}', [GigiController::class, 'generate'])->name('gigi.generate');

Route::get('/surat/{pasien}/tuberkulosis', [TuberkulosisController::class, 'index'])->name('tuberkulosis.index')->middleware('auth');
Route::get('/surat/{pasien}/tuberkulosis/create', [TuberkulosisController::class, 'create'])->name('tuberkulosis.create')->middleware('auth');
Route::post('/tuberkulosis', [TuberkulosisController::class, 'store'])->name('tuberkulosis.store');
Route::get('/surat/tuberkulosis/{tuberkulosis}', [TuberkulosisController::class, 'show'])->name('tuberkulosis.show')->middleware('auth');
Route::get('/surat/tuberkulosis/{tuberkulosis}/edit', [TuberkulosisController::class, 'edit'])->name('tuberkulosis.edit')->middleware('auth');
Route::put('/tuberkulosis/{tuberkulosis}', [TuberkulosisController::class, 'update'])->name('tuberkulosis.update');
Route::delete('/tuberkulosis/{id}', [TuberkulosisController::class, 'destroy'])->name('tuberkulosis.destroy');
Route::post('/tuberkulosis/generate/{tuberkulosis}', [TuberkulosisController::class, 'generate'])->name('tuberkulosis.generate');

// Route::get('/buat-surat/{pasien}/audiometri', [SuratController::class, 'dataAudiometri']);
// Route::get('/cetak-data/{audiometri}', [SuratController::class, 'cetakData']);
// Route::get('tambah-data-audiometri/{pasien}', [SuratController::class, 'tambahDataAudiometri']);
// Route::get('data-audiometri/{audiometri}', [SuratController::class, 'dataAudiometri']);
// Route::post('/generate/audiometri', [SuratController::class, 'audiometri']);