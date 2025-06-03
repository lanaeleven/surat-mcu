<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Hepatib;
use App\Models\Pasien;
use App\Models\Tuberkulosis;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HepatibController extends Controller
{
    public function index(Pasien $pasien)
    {
        $title = 'DATA PEMERIKSAAN HEPATITIS B';
        $jenisPemeriksaan = 'hepatib';
        $routeCreate = route('hepatib.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Hepatib::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien)
    {
        $title = 'TAMBAH DATA PEMERIKSAAN HEPATITIS B';
        $action = route('hepatib.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.hepatib', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->input());
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
            'noSurat' => 'nullable',
            'tanggalPemeriksaan' => 'required',
            'pekerjaanPasien' => 'nullable',
            'keperluanSurat' => 'nullable',
            'isHepatib' => 'nullable|boolean',
        ]);

        $hepatib = Hepatib::create($validatedData);
        return redirect()->route('hepatib.show', ['hepatib' => $hepatib->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Hepatib $hepatib)
    {
        $title = 'DATA PEMERIKSAAN HEPATITIS B';
        $action = route('hepatib.generate', ['hepatib' => $hepatib->id]);
        $pasien = $hepatib->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.hepatib', compact('title', 'hepatib', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Hepatib $hepatib)
    {
        $title = 'EDIT DATA PEMERIKSAAN HEPATITIS B';
        $pasien = $hepatib->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('hepatib.update', ['hepatib' => $hepatib->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.hepatib', compact('title', 'hepatib', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Hepatib $hepatib): RedirectResponse
    {
        // dd($request->input());
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
            'noSurat' => 'nullable',
            'tanggalPemeriksaan' => 'required',
            'pekerjaanPasien' => 'nullable',
            'keperluanSurat' => 'nullable',
            'isHepatib' => 'nullable|boolean',
        ]);
        $hepatib->update($validatedData);
        return redirect()->route('hepatib.show', ['hepatib' => $hepatib->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $hepatib = Hepatib::findOrFail($id);
        $idPasien = $hepatib->idPasien;
        $hepatib->delete();

        return redirect()->route('hepatib.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Hepatib $hepatib)
    {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($hepatib);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($hepatib->idPasien);
        $dokter = Dokter::find($hepatib->idDokter);
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($hepatib->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $hepatib->hariHijriyah;
        $tanggalHijriyahBulan = $hepatib->bulanHijriyah;
        $tanggalHijriyahTahun = $hepatib->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);

        $pdf = Pdf::loadView('template-surat.hepatib', [
            'hepatib' => $hepatib,
            'pasien' => $pasien,
            'dokter' => $dokter,
            'umur' => $umur,
            'tanggalPemeriksaan' => $tanggalPemeriksaan,
            'tanggalLahir' => $tanggalLahir,
            'tanggalPemeriksaanHari' => $tanggalPemeriksaanHari,
            'tanggalPemeriksaanBulan' => $tanggalPemeriksaanBulan,
            'tanggalPemeriksaanTahun' => $tanggalPemeriksaanTahun,
            'tanggalHijriyahHari' => $tanggalHijriyahHari,
            'tanggalHijriyahBulan' => $tanggalHijriyahBulan,
            'tanggalHijriyahTahun' => $tanggalHijriyahTahun,
        ]);
        return $pdf->stream("Pemeriksaan Hepatitis B " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
