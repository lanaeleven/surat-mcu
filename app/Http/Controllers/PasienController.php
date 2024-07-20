<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PasienController extends Controller
{
    public function create() {
        $pasiens = Pasien::orderBy('id', 'desc')->paginate(15);
        return view('home', ['pasiens' => $pasiens, 'title' => 'DATA PASIEN']);
    }

    public function tambahPasien() {
        return view('tambah-pasien', ['title' => 'TAMBAH PASIEN']);
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'nama' => 'required',
            'noRM' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'alamat' => 'required'
        ]);

        Pasien::create($validatedData);

        return redirect('/')
            ->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function edit(Pasien $pasien) {
        return view('edit-pasien', ['pasien' => $pasien, 'title' => 'EDIT PASIEN']);
    }

    public function buatSurat(Pasien $pasien) {
        return view('buat-surat', ['pasien' => $pasien, 'title' => 'BUAT SURAT']);
    }

    public function audiometri_(Pasien $pasien) {
        $dokter = Dokter::all();
        return view('audiometri', ['pasien' => $pasien, 'title' => 'Hasil Pemeriksaan Audiometri', 'dokter' => $dokter]);
    }
}