<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Screening;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class ScreeningController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN SCREENING';
        $jenisPemeriksaan = 'screening';
        $routeCreate = route('screening.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Screening::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN SCREENING';
        $action = route('screening.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.screening', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'dokterSpesialis' => 'required',
            'jenisScreening' => 'required',
            'hslPemeriksaan' => 'required',
            'statusKesehatan' => 'required',
        ]);
        $screening = Screening::create($validatedData);
        return redirect()->route('screening.show', ['screening' => $screening->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Screening $screening) {
        $title ='DATA PEMERIKSAAN SCREENING';
        $action = route('screening.generate', ['screening' => $screening->id]);
        $pasien = $screening->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.screening', compact('title', 'screening', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Screening $screening) {
        $title = 'EDIT DATA PEMERIKSAAN SCREENING';
        $pasien = $screening->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('screening.update', ['screening' => $screening->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.screening', compact('title','screening', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Screening $screening): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'dokterSpesialis' => 'required',
            'jenisScreening' => 'required',
            'hslPemeriksaan' => 'required',
            'statusKesehatan' => 'required',
        ]);
        $screening->update($validatedData);
        return redirect()->route('screening.show', ['screening' => $screening->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $screening = Screening::findOrFail($id);
        $idPasien = $screening->idPasien;
        $screening->delete();

        return redirect()->route('screening.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Screening $screening) {
        $pasien = Pasien::find($screening->idPasien);
        $dokter = Dokter::find($screening->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($screening->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyah = DateHelper::hijriyah($screening->tanggalPemeriksaan);
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);
        list($tanggalHijriyahHari, $tanggalHijriyahBulan, $tanggalHijriyahTahun) = explode(' ', $tanggalHijriyah);
        

        $pdf = Pdf::loadView('template-surat.screening', ['screening' => $screening, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalPemeriksaan' => $tanggalPemeriksaan, 'tanggalLahir' => $tanggalLahir, 
        'tanggalPemeriksaanHari' => $tanggalPemeriksaanHari, 
        'tanggalPemeriksaanBulan' => $tanggalPemeriksaanBulan, 
        'tanggalPemeriksaanTahun' => $tanggalPemeriksaanTahun, 
        'tanggalHijriyahHari' => $tanggalHijriyahHari,
        'tanggalHijriyahBulan' => $tanggalHijriyahBulan,
        'tanggalHijriyahTahun' => $tanggalHijriyahTahun,
        ]);
        return $pdf->stream("Surat Keterangan screening " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
