<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Vaksinasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Http\RedirectResponse;
use App\Helpers\DateHelper;

class VaksinasiController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN VAKSINASI';
        $jenisPemeriksaan = 'vaksinasi';
        $routeCreate = route('vaksinasi.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Vaksinasi::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN VAKSINASI';
        $action = route('vaksinasi.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.vaksinasi', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'jenisVaksin' => 'required',
            'tujuanVaksin' => 'required',
            'hariHijriyah' => 'required',
            'bulanHijriyah' => 'required',
            'tahunHijriyah' => 'required',
        ]);
        $vaksinasi = Vaksinasi::create($validatedData);
        return redirect()->route('vaksinasi.show', ['vaksinasi' => $vaksinasi->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Vaksinasi $vaksinasi) {
        $title ='DATA PEMERIKSAAN VAKSINASI';
        $action = route('vaksinasi.generate', ['vaksinasi' => $vaksinasi->id]);
        $pasien = $vaksinasi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.vaksinasi', compact('title', 'vaksinasi', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Vaksinasi $vaksinasi) {
        $title = 'EDIT DATA PEMERIKSAAN VAKSINASI';
        $pasien = $vaksinasi->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('vaksinasi.update', ['vaksinasi' => $vaksinasi->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.vaksinasi', compact('title','vaksinasi', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Vaksinasi $vaksinasi): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'jenisVaksin' => 'required',
            'tujuanVaksin' => 'required',
            'hariHijriyah' => 'required',
            'bulanHijriyah' => 'required',
            'tahunHijriyah' => 'required',
        ]);
        $vaksinasi->update($validatedData);
        return redirect()->route('vaksinasi.show', ['vaksinasi' => $vaksinasi->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $vaksinasi = Vaksinasi::findOrFail($id);
        $idPasien = $vaksinasi->idPasien;
        $vaksinasi->delete();

        return redirect()->route('vaksinasi.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Vaksinasi $vaksinasi) {
        $pasien = Pasien::find($vaksinasi->idPasien);
        $dokter = Dokter::find($vaksinasi->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($vaksinasi->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $vaksinasi->hariHijriyah;
        $tanggalHijriyahBulan = $vaksinasi->bulanHijriyah;
        $tanggalHijriyahTahun = $vaksinasi->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);
        

        $pdf = Pdf::loadView('template-surat.vaksinasi', 
        ['vaksinasi' => $vaksinasi, 
        'pasien' => $pasien, 
        'dokter' => $dokter, 
        'umur' => $umur, 
        'tanggalLahir' => $tanggalLahir, 
        'tanggalPemeriksaanHari' => $tanggalPemeriksaanHari, 
        'tanggalPemeriksaanBulan' => $tanggalPemeriksaanBulan, 
        'tanggalPemeriksaanTahun' => $tanggalPemeriksaanTahun, 
        'tanggalHijriyahHari' => $tanggalHijriyahHari,
        'tanggalHijriyahBulan' => $tanggalHijriyahBulan,
        'tanggalHijriyahTahun' => $tanggalHijriyahTahun,
    ]);
        return $pdf->stream("Surat Keterangan Vaksinasi " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}