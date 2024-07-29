<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gigi;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class GigiController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN GIGI';
        $jenisPemeriksaan = 'gigi';
        $routeCreate = route('gigi.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Gigi::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN GIGI';
        $action = route('gigi.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.gigi', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        // dd($request->input());
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'karangAtas' => 'required|boolean',
            'karangBawah' => 'required|boolean',
            'decay' => 'required',
            'missing' => 'required',
            'filling' => 'required',
            'sisaAkar' => 'required',
            'jaringanLunak' => 'required',
            'lainnya' => '',
            'kesimpulan' => 'required',
        ]);

        $gigi = Gigi::create($validatedData);
        return redirect()->route('gigi.show', ['gigi' => $gigi->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Gigi $gigi) {
        $title ='DATA PEMERIKSAAN GIGI';
        $action = route('gigi.generate', ['gigi' => $gigi->id]);
        $pasien = $gigi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.gigi', compact('title', 'gigi', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Gigi $gigi) {
        $title = 'EDIT DATA PEMERIKSAAN GIGI';
        $pasien = $gigi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('gigi.update', ['gigi' => $gigi->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.gigi', compact('title','gigi', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Gigi $gigi): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'karangAtas' => 'required|boolean',
            'karangBawah' => 'required|boolean',
            'decay' => 'required',
            'missing' => 'required',
            'filling' => 'required',
            'sisaAkar' => 'required',
            'jaringanLunak' => 'required',
            'lainnya' => '',
            'kesimpulan' => 'required',
        ]);
        $gigi->update($validatedData);
        return redirect()->route('gigi.show', ['gigi' => $gigi->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $gigi = Gigi::findOrFail($id);
        $idPasien = $gigi->idPasien;
        $gigi->delete();

        return redirect()->route('gigi.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Gigi $gigi) {
        $pasien = Pasien::find($gigi->idPasien);
        $dokter = Dokter::find($gigi->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($gigi->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        
        $pdf = Pdf::loadView('template-surat.gigi', [
            'gigi' => $gigi, 
            'pasien' => $pasien, 
            'dokter' => $dokter, 
            'umur' => $umur, 
            'tanggalPemeriksaan' => $tanggalPemeriksaan, 
            'tanggalLahir' => $tanggalLahir
        ]);
        return $pdf->stream("Pemeriksaan Dokter Gigi " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
