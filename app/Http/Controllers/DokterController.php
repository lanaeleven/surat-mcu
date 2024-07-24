<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class DokterController extends Controller
{
    public function index() {
        $title = 'DATA DOKTER';
        $dokter = Dokter::orderBy('id', 'desc')->get();
        return view('dokter.index', compact('title', 'dokter'));
    }

    public function create() {
        $title ='TAMBAH DOKTER';
        $readonly = false;
        return view('dokter.form', compact('title', 'readonly'));
    }

    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'nama' => 'required',
            'sip' => 'required|unique:dokter'
        ]);
        Dokter::create($validatedData);
        return redirect()->route('dokter.index')->with('success', "Data Dokter Berhasil Ditambahkan");
    }

    public function edit(Dokter $dokter) {
        $title = 'EDIT DOKTER';
        $readonly = false;
        return view('dokter.form', compact('title','dokter', 'readonly'));
    }

    public function update(Request $request, Dokter $dokter): RedirectResponse {
        $validatedData = $request->validate([
            'nama' => 'required',
            'sip' => [
                'required',
                Rule::unique('dokter')->ignore($dokter->id),    
            ]
        ]);
        $dokter->update($validatedData);
        return redirect()->route('dokter.index')->with('success', "Data Dokter Berhasil Disimpan");
    }
}
