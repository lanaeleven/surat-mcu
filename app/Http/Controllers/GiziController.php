<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gizi;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class GiziController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN GIZI';
        $jenisPemeriksaan = 'gizi';
        $routeCreate = route('gizi.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Gizi::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN GIZI';
        $action = route('gizi.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.gizi', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'nullable',
            'tinggiBadan' => 'nullable',
            'denyutNadi' => 'nullable',
            'tekananDarah' => 'nullable',
            'spo2' => 'nullable',
            'beratBadan' => 'nullable',
            'frekuensiNafas' => 'nullable',
            'suhuBadan' => 'nullable',
            'imt' => 'nullable',
            'hslBIA' => 'nullable',
            'statusGizi' => 'nullable',
            'rekomTerapiGizi' => 'nullable',
            'saran' => 'nullable',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
        ]);
        $gizi = Gizi::create($validatedData);
        return redirect()->route('gizi.show', ['gizi' => $gizi->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Gizi $gizi) {
        $title ='DATA PEMERIKSAAN GIZI';
        $action = route('gizi.generate', ['gizi' => $gizi->id]);
        $pasien = $gizi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.gizi', compact('title', 'gizi', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Gizi $gizi) {
        $title = 'EDIT DATA PEMERIKSAAN GIZI';
        $pasien = $gizi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('gizi.update', ['gizi' => $gizi->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.gizi', compact('title','gizi', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Gizi $gizi): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'nullable',
            'tinggiBadan' => 'nullable',
            'denyutNadi' => 'nullable',
            'tekananDarah' => 'nullable',
            'spo2' => 'nullable',
            'beratBadan' => 'nullable',
            'frekuensiNafas' => 'nullable',
            'suhuBadan' => 'nullable',
            'imt' => 'nullable',
            'hslBIA' => 'nullable',
            'statusGizi' => 'nullable',
            'rekomTerapiGizi' => 'nullable',
            'saran' => 'nullable',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
        ]);
        $gizi->update($validatedData);
        return redirect()->route('gizi.show', ['gizi' => $gizi->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $gizi = Gizi::findOrFail($id);
        $idPasien = $gizi->idPasien;
        $gizi->delete();

        return redirect()->route('gizi.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Gizi $gizi) {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($gizi);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($gizi->idPasien);
        $dokter = Dokter::find($gizi->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($gizi->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $gizi->hariHijriyah;
        $tanggalHijriyahBulan = $gizi->bulanHijriyah;
        $tanggalHijriyahTahun = $gizi->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);
        

        $pdf = Pdf::loadView('template-surat.gizi', 
        ['gizi' => $gizi, 
        'pasien' => $pasien, 
        'dokter' => $dokter, 
        'umur' => $umur, 
        'tanggalLahir' => $tanggalLahir, 
        'tanggalPemeriksaan' => $tanggalPemeriksaan,
        'tanggalPemeriksaanHari' => $tanggalPemeriksaanHari, 
        'tanggalPemeriksaanBulan' => $tanggalPemeriksaanBulan, 
        'tanggalPemeriksaanTahun' => $tanggalPemeriksaanTahun,
        'tanggalHijriyahHari' => $tanggalHijriyahHari,
        'tanggalHijriyahBulan' => $tanggalHijriyahBulan,
        'tanggalHijriyahTahun' => $tanggalHijriyahTahun,
        ]);
        return $pdf->stream("Surat Keterangan Hasil Pemeriksaan Gizi " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
