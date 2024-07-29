<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Treadmill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class TreadmillController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN TREADMILL';
        $jenisPemeriksaan = 'treadmill';
        $routeCreate = route('treadmill.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Treadmill::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN TREADMILL';
        $action = route('treadmill.store');
        $dokter = Dokter::all();
        $readonly = false;
        return view('form-surat.treadmill', compact('title', 'pasien', 'dokter', 'readonly', 'action'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
        ]);
        $treadmill = Treadmill::create($validatedData);
        return redirect()->route('treadmill.show', ['treadmill' => $treadmill->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Treadmill $treadmill) {
        $title ='DATA PEMERIKSAAN TREADMILL';
        $action = route('treadmill.generate', ['treadmill' => $treadmill->id]);
        $pasien = $treadmill->pasien;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.treadmill', compact('title', 'treadmill', 'readonly', 'pasien', 'dokter', 'action', 'blank'));
    }

    public function edit(Treadmill $treadmill) {
        $title = 'EDIT DATA PEMERIKSAAN TREADMILL';
        $pasien = $treadmill->pasien;
        $action = route('treadmill.update', ['treadmill' => $treadmill->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.treadmill', compact('title','treadmill', 'pasien', 'readonly', 'dokter', 'action', 'put'));
    }

    public function update(Request $request, Treadmill $treadmill): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
        ]);
        $treadmill->update($validatedData);
        return redirect()->route('treadmill.show', ['treadmill' => $treadmill->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $treadmill = Treadmill::findOrFail($id);
        $idPasien = $treadmill->idPasien;
        $treadmill->delete();

        return redirect()->route('treadmill.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Treadmill $treadmill) {
        $pasien = Pasien::find($treadmill->idPasien);
        $dokter = Dokter::find($treadmill->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalPemeriksaan = Carbon::parse($treadmill->tanggalPemeriksaan)->translatedFormat('d F Y');

        $pdf = Pdf::loadView('template-surat.treadmill', [
            'treadmill' => $treadmill, 
            'pasien' => $pasien, 
            'dokter' => $dokter, 
            'umur' => $umur, 
            'tanggalLahir' => $tanggalLahir,
            'tanggalPemeriksaan' => $tanggalPemeriksaan,
        ]);
        return $pdf->stream("Hasil Pemeriksaan Treadmill " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
