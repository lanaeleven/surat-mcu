<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tuberkulosis;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TuberkulosisController extends Controller
{
    public function index(Pasien $pasien)
    {
        $title = 'DATA PEMERIKSAAN TUBERKULOSIS';
        $jenisPemeriksaan = 'tuberkulosis';
        $routeCreate = route('tuberkulosis.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Tuberkulosis::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien)
    {
        $title = 'TAMBAH DATA PEMERIKSAAN TUBERKULOSIS';
        $action = route('tuberkulosis.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.tuberkulosis', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
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
            'isThorax' => 'nullable|boolean',
            'keteranganThorax' => 'nullable',
            'isSputum' => 'nullable|boolean',
            'isTbc' => 'nullable|boolean',
        ]);

        $tuberkulosis = Tuberkulosis::create($validatedData);
        return redirect()->route('tuberkulosis.show', ['tuberkulosis' => $tuberkulosis->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Tuberkulosis $tuberkulosis)
    {
        $title = 'DATA PEMERIKSAAN TUBERKULOSIS';
        $action = route('tuberkulosis.generate', ['tuberkulosis' => $tuberkulosis->id]);
        $pasien = $tuberkulosis->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.tuberkulosis', compact('title', 'tuberkulosis', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Tuberkulosis $tuberkulosis)
    {
        $title = 'EDIT DATA PEMERIKSAAN TUBERKULOSIS';
        $pasien = $tuberkulosis->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('tuberkulosis.update', ['tuberkulosis' => $tuberkulosis->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.tuberkulosis', compact('title', 'tuberkulosis', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Tuberkulosis $tuberkulosis): RedirectResponse
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
            'isThorax' => 'nullable|boolean',
            'keteranganThorax' => 'nullable',
            'isSputum' => 'nullable|boolean',
            'isTbc' => 'nullable|boolean',
        ]);
        $tuberkulosis->update($validatedData);
        return redirect()->route('tuberkulosis.show', ['tuberkulosis' => $tuberkulosis->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $tuberkulosis = Tuberkulosis::findOrFail($id);
        $idPasien = $tuberkulosis->idPasien;
        $tuberkulosis->delete();

        return redirect()->route('tuberkulosis.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Tuberkulosis $tuberkulosis)
    {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($tuberkulosis);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($tuberkulosis->idPasien);
        $dokter = Dokter::find($tuberkulosis->idDokter);
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($tuberkulosis->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $tuberkulosis->hariHijriyah;
        $tanggalHijriyahBulan = $tuberkulosis->bulanHijriyah;
        $tanggalHijriyahTahun = $tuberkulosis->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);

        $pdf = Pdf::loadView('template-surat.tuberkulosis', [
            'tuberkulosis' => $tuberkulosis,
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
        return $pdf->stream("Pemeriksaan Tuberkulosis " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
