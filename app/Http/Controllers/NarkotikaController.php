<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Narkotika;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class NarkotikaController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN NARKOTIKA';
        $jenisPemeriksaan = 'narkotika';
        $routeCreate = route('narkotika.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = Narkotika::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN NARKOTIKA';
        $action = route('narkotika.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.narkotika', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        // dd($request->input());
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'nullable',
            'pekerjaanPasien' => 'nullable',
            'hslWawancara' => 'nullable',
            'coccaine' => 'nullable|boolean',
            'methamphetamine' => 'nullable|boolean',
            'morphin' => 'nullable|boolean',
            'marijuana' => 'nullable|boolean',
            'benzodiazepines' => 'nullable|boolean',
            'amphetamine' => 'nullable|boolean',
            'kesimpulan' => 'nullable|boolean',
            'keperluanSurat' => 'nullable',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
        ]);
        $narkotika = Narkotika::create($validatedData);
        return redirect()->route('narkotika.show', ['narkotika' => $narkotika->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(Narkotika $narkotika) {
        $title ='DATA PEMERIKSAAN NARKOTIKA';
        $action = route('narkotika.generate', ['narkotika' => $narkotika->id]);
        $pasien = $narkotika->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.narkotika', compact('title', 'narkotika', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(Narkotika $narkotika) {
        $title = 'EDIT DATA PEMERIKSAAN NARKOTIKA';
        $pasien = $narkotika->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('narkotika.update', ['narkotika' => $narkotika->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.narkotika', compact('title','narkotika', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, Narkotika $narkotika): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'nullable',
            'pekerjaanPasien' => 'nullable',
            'hslWawancara' => 'nullable',
            'coccaine' => 'nullable|boolean',
            'methamphetamine' => 'nullable|boolean',
            'morphin' => 'nullable|boolean',
            'marijuana' => 'nullable|boolean',
            'benzodiazepines' => 'nullable|boolean',
            'amphetamine' => 'nullable|boolean',
            'kesimpulan' => 'nullable|boolean',
            'keperluanSurat' => 'nullable',
            'hariHijriyah' => 'nullable',
            'bulanHijriyah' => 'nullable',
            'tahunHijriyah' => 'nullable',
        ]);
        $narkotika->update($validatedData);
        return redirect()->route('narkotika.show', ['narkotika' => $narkotika->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $narkotika = Narkotika::findOrFail($id);
        $idPasien = $narkotika->idPasien;
        $narkotika->delete();

        return redirect()->route('narkotika.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(Narkotika $narkotika) {

        // Memeriksa apakah data sudah lengkap atau belum sebelum mengenerate surat
        $checkNull = collect($narkotika);
        $hasNull = $checkNull->contains(function ($value) {
            return is_null($value);
        });
        if ($hasNull) {
            return redirect()->back()->with('alert', 'Masih ada data yang belum lengkap');
        }

        $pasien = Pasien::find($narkotika->idPasien);
        $dokter = Dokter::find($narkotika->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($narkotika->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyahHari = $narkotika->hariHijriyah;
        $tanggalHijriyahBulan = $narkotika->bulanHijriyah;
        $tanggalHijriyahTahun = $narkotika->tahunHijriyah;
        list($tanggalPemeriksaanHari, $tanggalPemeriksaanBulan, $tanggalPemeriksaanTahun) = explode(' ', $tanggalPemeriksaan);
        
        $pdf = Pdf::loadView('template-surat.narkotika', ['narkotika' => $narkotika, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalPemeriksaan' => $tanggalPemeriksaan, 'tanggalLahir' => $tanggalLahir, 
        'tanggalPemeriksaanHari' => $tanggalPemeriksaanHari, 
        'tanggalPemeriksaanBulan' => $tanggalPemeriksaanBulan, 
        'tanggalPemeriksaanTahun' => $tanggalPemeriksaanTahun, 
        'tanggalHijriyahHari' => $tanggalHijriyahHari,
        'tanggalHijriyahBulan' => $tanggalHijriyahBulan,
        'tanggalHijriyahTahun' => $tanggalHijriyahTahun,
        ]);
        return $pdf->stream("Surat Keterangan Hasil Pemeriksaan Narkotika " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}
