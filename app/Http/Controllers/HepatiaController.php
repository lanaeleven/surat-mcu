<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Hepatia;
use App\Models\Pasien;
use App\Models\Tuberkulosis;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HepatiaController extends Controller
{
    public function index(Pasien $pasien)
    {
        $title = 'DATA PEMERIKSAAN HEPATITIS A';
        $jenisPemeriksaan = 'hepatia';
        $routeCreate = route('hepatia.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Hepatia::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien)
    {
        $title = 'TAMBAH DATA PEMERIKSAAN HEPATITIS A';
        $action = route('hepatia.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.hepatia', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
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
            'isHepatia' => 'nullable|boolean',
        ]);

        $hepatia = Hepatia::create($validatedData);
        return redirect()->route('hepatia.show', ['hepatia' => $hepatia->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Hepatia $hepatia)
    {
        $title = 'DATA PEMERIKSAAN HEPATITIS A';
        $action = route('hepatia.generate', ['hepatia' => $hepatia->id]);
        $pasien = $hepatia->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.hepatia', compact('title', 'hepatia', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Hepatia $hepatia)
    {
        $title = 'EDIT DATA PEMERIKSAAN HEPATITIS A';
        $pasien = $hepatia->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('hepatia.update', ['hepatia' => $hepatia->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.hepatia', compact('title', 'hepatia', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Hepatia $hepatia): RedirectResponse
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
            'isHepatia' => 'nullable|boolean',
        ]);
        $hepatia->update($validatedData);
        return redirect()->route('hepatia.show', ['hepatia' => $hepatia->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $hepatia = Hepatia::findOrFail($id);
        $idPasien = $hepatia->idPasien;
        $hepatia->delete();

        return redirect()->route('hepatia.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Hepatia $hepatia)
    {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($hepatia);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($hepatia->idPasien);
        $dokter = Dokter::find($hepatia->idDokter);
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($hepatia->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $hepatia->hariHijriyah;
        $tanggalHijriyahBulan = $hepatia->bulanHijriyah;
        $tanggalHijriyahTahun = $hepatia->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);

        $pdf = Pdf::loadView('template-surat.hepatia', [
            'hepatia' => $hepatia,
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
        return $pdf->stream("Pemeriksaan Hepatitis A " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
