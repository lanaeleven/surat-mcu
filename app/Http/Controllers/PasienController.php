<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\MedicalReport;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PasienController extends Controller
{
    public function index()
    {
        $title = 'DATA PASIEN';
        $pasien = Pasien::orderBy('id', 'desc')->paginate(15);
        return view('pasien.index', compact('title', 'pasien'));
    }

    public function create()
    {
        $title = 'TAMBAH PASIEN';
        $readonly = false;
        return view('pasien.form', compact('title', 'readonly'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'noRM' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'alamat' => 'required'
        ]);
        Pasien::create($validatedData);
        return redirect()->route('pasien.index')->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function edit(Pasien $pasien)
    {
        $title = 'EDIT PASIEN';
        $readonly = false;
        return view('pasien.form', compact('title', 'pasien', 'readonly'));
    }

    public function update(Request $request, Pasien $pasien): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'noRM' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'alamat' => 'required'
        ]);
        $pasien->update($validatedData);
        return redirect()->route('pasien.index')->with('success', "Data Pasien Berhasil Disimpan");
    }

    public function audiometri_(Pasien $pasien)
    {
        $dokter = Dokter::all();
        return view('audiometri', ['pasien' => $pasien, 'title' => 'Hasil Pemeriksaan Audiometri', 'dokter' => $dokter]);
    }

    public function indexSurat(Pasien $pasien)
    {
        $title = 'BUAT SURAT';
        $audiometriCount = $pasien->audiometri()->count();
        $spirometriCount = $pasien->spirometri()->count();
        $vaksinasiCount = $pasien->vaksinasi()->count();
        $giziCount = $pasien->gizi()->count();
        $medicalReportCount = $pasien->medicalReport()->count();
        $gigiCount = $pasien->gigi()->count();
        $screeningCount = $pasien->screening()->count();
        $kesehatanBadanCount = $pasien->kesehatanBadan()->count();
        $narkotikaCount = $pasien->narkotika()->count();
        $treadmillCount = $pasien->treadmill()->count();
        $tuberkulosisCount = $pasien->tuberkulosis()->count();

        return view('surat-index', compact('title', 'pasien', 'audiometriCount', 'spirometriCount', 'vaksinasiCount', 'giziCount', 'medicalReportCount', 'gigiCount', 'screeningCount', 'kesehatanBadanCount', 'narkotikaCount', 'treadmillCount', 'tuberkulosisCount'));
    }
}
