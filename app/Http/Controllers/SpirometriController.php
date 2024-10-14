<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Spirometri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
            'diagAwal' => 'nullable',
            'hslPemeriksaan' => 'nullable',
            'kesimpulan' => 'nullable',
            'saran' => 'nullable',
        ]);
        $spirometri = Spirometri::create($validatedData);
        return redirect()->route('spirometri.show', ['spirometri' => $spirometri->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Spirometri $spirometri) {
        $title ='DATA PEMERIKSAAN SPIROMETRI';
        $action = route('spirometri.generate', ['spirometri' => $spirometri->id]);
        $pasien = $spirometri->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.spirometri', compact('title', 'spirometri', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Spirometri $spirometri) {
        $title = 'EDIT DATA PEMERIKSAAN SPIROMETRI';
        $pasien = $spirometri->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('spirometri.update', ['spirometri' => $spirometri->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.spirometri', compact('title','spirometri', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Spirometri $spirometri): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'diagAwal' => 'nullable',
            'hslPemeriksaan' => 'nullable',
            'kesimpulan' => 'nullable',
            'saran' => 'nullable',
        ]);
        $spirometri->update($validatedData);
        return redirect()->route('spirometri.show', ['spirometri' => $spirometri->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $spirometri = Spirometri::findOrFail($id);
        $idPasien = $spirometri->idPasien;
        $spirometri->delete();

        return redirect()->route('spirometri.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Spirometri $spirometri) {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($spirometri);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($spirometri->idPasien);
        $dokter = Dokter::find($spirometri->idDokter);
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($spirometri->tanggalPemeriksaan)->translatedFormat('d F Y');

        $pdf = Pdf::loadView('template-surat.spirometri', ['spirometri' => $spirometri, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalPemeriksaan' => $tanggalPemeriksaan]);
        return $pdf->stream("Hasil Pemeriksaan Spirometri " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
