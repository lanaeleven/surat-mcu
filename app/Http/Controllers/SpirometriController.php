<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Spirometri;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SpirometriController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN SPIROMETRI';
        $jenisPemeriksaan = 'spirometri';
        $routeCreate = route('spirometri.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Spirometri::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN SPIROMETRI';
        $action = route('spirometri.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.spirometri', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'diagAwal' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
            'saran' => 'required',
        ]);
        $spirometri = Spirometri::create($validatedData);
        return redirect()->route('spirometri.show', ['spirometri' => $spirometri->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Spirometri $spirometri) {
        $title ='DATA PEMERIKSAAN SPIROMETRI';
        $action = route('spirometri.generate', ['spirometri' => $spirometri->id]);
        $pasien = $spirometri->pasien;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.spirometri', compact('title', 'spirometri', 'readonly', 'pasien', 'dokter', 'action', 'blank'));
    }

    // public function edit(Audiometri $audiometri) {
    //     $title = 'EDIT DATA PEMERIKSAAN AUDIOMETRI';
    //     $pasien = $audiometri->pasien;
    //     $action = route('audiometri.update', ['audiometri' => $audiometri->id]);
    //     $readonly = false;
    //     $dokter = Dokter::all();
    //     $put = true;
    //     return view('form-surat.audiometri', compact('title','audiometri', 'pasien', 'readonly', 'dokter', 'action', 'put'));
    // }

    // public function update(Request $request, Audiometri $audiometri): RedirectResponse {
    //     $validatedData = $request->validate([
    //         'idPasien' => 'required',
    //         'idDokter' => 'required',
    //         'hslPemeriksaan' => 'required',
    //         'kesimpulan' => 'required',
    //     ]);
    //     $audiometri->update($validatedData);
    //     return redirect()->route('audiometri.show', ['audiometri' => $audiometri->id])->with('success', "Data Pasien Berhasil Diupdate");
    // }

    // public function destroy($id) {
    //     $audiometri = Audiometri::findOrFail($id);
    //     $idPasien = $audiometri->idPasien;
    //     $audiometri->delete();

    //     return redirect()->route('audiometri.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    // }

    // public function generate(Audiometri $audiometri) {
    //     $pasien = Pasien::find($audiometri->idPasien);
    //     $dokter = Dokter::find($audiometri->idDokter);  

    //     $pdf = Pdf::loadView('template-surat.audiometri', ['audiometri' => $audiometri, 'pasien' => $pasien, 'dokter' => $dokter]);
    //     return $pdf->stream("Hasil Pemeriksaan Audiometri " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    // }
}
