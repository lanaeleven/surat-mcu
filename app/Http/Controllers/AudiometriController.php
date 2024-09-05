<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Audiometri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class AudiometriController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN AUDIOMETRI';
        $jenisPemeriksaan = 'audiometri';
        $routeCreate = route('audiometri.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Audiometri::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN AUDIOMETRI';
        $action = route('audiometri.store');
        $dokter = Dokter::all();
        $readonly = false;
        return view('form-surat.audiometri', compact('title', 'pasien', 'dokter', 'readonly', 'action'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
            'tanggalPemeriksaan' => 'required',
        ]);
        $audiometri = Audiometri::create($validatedData);
        return redirect()->route('audiometri.show', ['audiometri' => $audiometri->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Audiometri $audiometri) {
        $title ='DATA PEMERIKSAAN AUDIOMETRI';
        $action = route('audiometri.generate', ['audiometri' => $audiometri->id]);
        $pasien = $audiometri->pasien;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.audiometri', compact('title', 'audiometri', 'readonly', 'pasien', 'dokter', 'action', 'blank'));
    }

    public function edit(Audiometri $audiometri) {
        $title = 'EDIT DATA PEMERIKSAAN AUDIOMETRI';
        $pasien = $audiometri->pasien;
        $action = route('audiometri.update', ['audiometri' => $audiometri->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.audiometri', compact('title','audiometri', 'pasien', 'readonly', 'dokter', 'action', 'put'));
    }

    public function update(Request $request, Audiometri $audiometri): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
            'tanggalPemeriksaan' => 'required',
        ]);
        $audiometri->update($validatedData);
        return redirect()->route('audiometri.show', ['audiometri' => $audiometri->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $audiometri = Audiometri::findOrFail($id);
        $idPasien = $audiometri->idPasien;
        $audiometri->delete();

        return redirect()->route('audiometri.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Audiometri $audiometri) {
        $pasien = Pasien::find($audiometri->idPasien);
        $dokter = Dokter::find($audiometri->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalPemeriksaan = Carbon::parse($audiometri->tanggalPemeriksaan)->translatedFormat('d F Y');

        $pdf = Pdf::loadView('template-surat.audiometri', ['audiometri' => $audiometri, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalLahir' => $tanggalLahir, 'tanggalPemeriksaan' => $tanggalPemeriksaan]);
        return $pdf->stream("Hasil Pemeriksaan Audiometri " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
