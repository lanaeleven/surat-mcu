<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Models\KesehatanBadan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class KesehatanBadanController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN KESEHATAN BADAN';
        $jenisPemeriksaan = 'kesehatanBadan';
        $routeCreate = route('kesehatanBadan.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = KesehatanBadan::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN KESEHATAN BADAN';
        $action = route('kesehatanBadan.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.kesehatanBadan', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        // dd($request->input());
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'tinggiBadan' => 'required',
            'denyutNadi' => 'required',
            'tekananDarah' => 'required',
            'spo2' => 'required',
            'beratBadan' => 'required',
            'frekuensiNafas' => 'required',
            'suhuBadan' => 'required',
            'imt' => 'required',
            'sehat' => 'required|boolean',
            'sakit' => 'required|boolean',
            'cacat' => 'required|boolean',
            'tidakCacat' => 'required|boolean',
            'keperluanSurat' => 'required',
        ]);
        $kesehatanBadan = KesehatanBadan::create($validatedData);
        return redirect()->route('kesehatanBadan.show', ['kesehatanBadan' => $kesehatanBadan->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(KesehatanBadan $kesehatanBadan) {
        $title ='DATA PEMERIKSAAN KESEHATAN BADAN';
        $action = route('kesehatanBadan.generate', ['kesehatanBadan' => $kesehatanBadan->id]);
        $pasien = $kesehatanBadan->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.kesehatanBadan', compact('title', 'kesehatanBadan', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(KesehatanBadan $kesehatanBadan) {
        $title = 'EDIT DATA PEMERIKSAAN KESEHATAN BADAN';
        $pasien = $kesehatanBadan->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('kesehatanBadan.update', ['kesehatanBadan' => $kesehatanBadan->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.kesehatanBadan', compact('title','kesehatanBadan', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, KesehatanBadan $kesehatanBadan): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'tinggiBadan' => 'required',
            'denyutNadi' => 'required',
            'tekananDarah' => 'required',
            'spo2' => 'required',
            'beratBadan' => 'required',
            'frekuensiNafas' => 'required',
            'suhuBadan' => 'required',
            'imt' => 'required',
            'sehat' => 'required|boolean',
            'sakit' => 'required|boolean',
            'cacat' => 'required|boolean',
            'tidakCacat' => 'required|boolean',
            'keperluanSurat' => 'required',
        ]);
        $kesehatanBadan->update($validatedData);
        return redirect()->route('kesehatanBadan.show', ['kesehatanBadan' => $kesehatanBadan->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $kesehatanBadan = KesehatanBadan::findOrFail($id);
        $idPasien = $kesehatanBadan->idPasien;
        $kesehatanBadan->delete();

        return redirect()->route('kesehatanBadan.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(KesehatanBadan $kesehatanBadan) {
        $pasien = Pasien::find($kesehatanBadan->idPasien);
        $dokter = Dokter::find($kesehatanBadan->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($kesehatanBadan->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyah = DateHelper::hijriyah($kesehatanBadan->tanggalPemeriksaan);
        
        $pdf = Pdf::loadView('template-surat.kesehatan-badan', ['kesehatanBadan' => $kesehatanBadan, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalPemeriksaan' => $tanggalPemeriksaan, 'tanggalLahir' => $tanggalLahir, 'tanggalHijriyah' => $tanggalHijriyah]);
        return $pdf->stream("Surat Keterangan Kesehatan Badan " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}