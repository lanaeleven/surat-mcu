<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Models\MedicalReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class MedicalReportController extends Controller
{
    public function index(Pasien $pasien) {
        $title = 'DATA PEMERIKSAAN MEDICAL REPORT';
        $jenisPemeriksaan = 'medicalReport';
        $routeCreate = route('medicalReport.create', ['pasien' => $pasien->id]);
        $dataPemeriksaan = MedicalReport::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', compact('title', 'dataPemeriksaan', 'pasien', 'routeCreate', 'jenisPemeriksaan'));
    }

    public function create(Pasien $pasien) {
        $title ='TAMBAH DATA PEMERIKSAAN MEDICAL REPORT';
        $action = route('medicalReport.store');
        $dokter = Dokter::all();
        $readonly = false;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        return view('form-surat.medicalReport', compact('title', 'pasien', 'dokter', 'readonly', 'action', 'umur'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'tinggiBadan' => 'required',
            'denyutNadi' => 'required',
            'tekananDarah' => 'required',
            'spo2' => 'required',
            'beratBadan' => 'required',
            'frekuensiNafas' => 'required',
            'suhuBadan' => 'required',
            'imt' => 'required',
            'hslPemeriksaan' => 'required',
            'saran' => 'required',
        ]);
        $medicalReport = MedicalReport::create($validatedData);
        return redirect()->route('medicalReport.show', ['medicalReport' => $medicalReport->id])->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function show(MedicalReport $medicalReport) {
        $title ='DATA PEMERIKSAAN MEDICAL REPORT';
        $action = route('medicalReport.generate', ['medicalReport' => $medicalReport->id]);
        $pasien = $medicalReport->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $dokter = Dokter::all();
        $readonly = true;
        $blank = true;
        return view('form-surat.medicalReport', compact('title', 'medicalReport', 'readonly', 'pasien', 'dokter', 'action', 'blank', 'umur'));
    }

    public function edit(MedicalReport $medicalReport) {
        $title = 'EDIT DATA PEMERIKSAAN MEDICAL REPORT';
        $pasien = $medicalReport->pasien;
        $umur = Carbon::parse($pasien->tanggalLahir)->age;
        $action = route('medicalReport.update', ['medicalReport' => $medicalReport->id]);
        $readonly = false;
        $dokter = Dokter::all();
        $put = true;
        return view('form-surat.medicalReport', compact('title','medicalReport', 'pasien', 'readonly', 'dokter', 'action', 'put', 'umur'));
    }

    public function update(Request $request, MedicalReport $medicalReport): RedirectResponse {
        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'tanggalPemeriksaan' => 'required',
            'noSurat' => 'required',
            'tinggiBadan' => 'required',
            'denyutNadi' => 'required',
            'tekananDarah' => 'required',
            'spo2' => 'required',
            'beratBadan' => 'required',
            'frekuensiNafas' => 'required',
            'suhuBadan' => 'required',
            'imt' => 'required',
            'hslPemeriksaan' => 'required',
            'saran' => 'required',
        ]);
        $medicalReport->update($validatedData);
        return redirect()->route('medicalReport.show', ['medicalReport' => $medicalReport->id])->with('success', "Data Pasien Berhasil Diupdate");
    }

    public function destroy($id) {
        $medicalReport = MedicalReport::findOrFail($id);
        $idPasien = $medicalReport->idPasien;
        $medicalReport->delete();

        return redirect()->route('medicalReport.index', ['pasien' => $idPasien])->with('success', "Data Pasien Berhasil Dihapus");
    }

    public function generate(MedicalReport $medicalReport) {
        $pasien = Pasien::find($medicalReport->idPasien);
        $dokter = Dokter::find($medicalReport->idDokter);  
        $umur = Carbon::parse($pasien->tanggalLahir)->age;

        Carbon::setLocale('id');
        $tanggalPemeriksaan = Carbon::parse($medicalReport->tanggalPemeriksaan)->translatedFormat('d F Y');
        $tanggalLahir = Carbon::parse($pasien->tanggalLahir)->translatedFormat('d F Y');
        $tanggalHijriyah = DateHelper::hijriyah($medicalReport->tanggalPemeriksaan);
        
        $pdf = Pdf::loadView('template-surat.medical-report', ['medicalReport' => $medicalReport, 'pasien' => $pasien, 'dokter' => $dokter, 'umur' => $umur, 'tanggalPemeriksaan' => $tanggalPemeriksaan, 'tanggalLahir' => $tanggalLahir, 'tanggalHijriyah' => $tanggalHijriyah]);
        return $pdf->stream("Medical Report " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
    }
}