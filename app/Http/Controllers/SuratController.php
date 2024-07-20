<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Audiometri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{

    public function dataAudiometri(Pasien $pasien) {
        $audiometri = Audiometri::where('idPasien', $pasien->id)->get();
        return view('data-pemeriksaan', ['audiometri' => $audiometri, 'title' => 'Data Pemeriksaan Audiometri']);
    }

    public function audiometri(Request $request) {
        // dd($request->input());

        $validatedData = $request->validate([
            'idPasien' => 'required',
            'idDokter' => 'required',
            'hslPemeriksaan' => 'required',
            'kesimpulan' => 'required',
        ]);

        $audiometri = Audiometri::create($validatedData);
        $pasien = Pasien::find($audiometri->idPasien);
        $dokter = Dokter::find($audiometri->idDokter);  

        $pdf = Pdf::loadView('template.audiometri', ['audiometri' => $audiometri, 'pasien' => $pasien, 'dokter' => $dokter]);
        return $pdf->stream("Hasil Pemeriksaan Audiometri " . $pasien->nama . " (" . $pasien->noRM . ").pdf");
        // return $pdf->stream("audiometri.pdf");

        // $timestamp = now()->timestamp; // Mendapatkan timestamp saat ini
        // $dompdfFilePath = storage_path('app/public/uploads/disposisi/disposisi_' . $timestamp . '.pdf');
        // file_put_contents($dompdfFilePath, $pdf->output());

        // return redirect('/')
        //     ->with('success', "Data Pasien Berhasil Ditambahkan");
    }

    public function test() {
        $pdf = Pdf::loadView('template.narkotika');
        return $pdf->stream();
    }
}
