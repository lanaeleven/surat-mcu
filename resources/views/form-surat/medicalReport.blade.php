@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('medicalReport.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
    </div>
    <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">

    <div class="flex justify-start">
        <div class="flex-row">
            <div class="flex">
                <div class="flex-none w-44">Nama</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->nama }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">TTL</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->tempatLahir }}, {{ $pasien->tanggalLahir }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">Jenis Kelamin</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->jenisKelamin }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">Alamat</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->alamat }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">Nomor RM</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->noRM }}</div>
            </div>
        </div>
    </div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">

    <form action="{{ $action }}" method="post" @if (isset($blank)) target="_blank" @endif>
        @csrf
        @if(isset($put))
        @method('PUT')
        @endif

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mb-6">
            <input type="hidden" name="idPasien" value="{{ $pasien->id }}" >
            <div>
                <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $medicalReport->noSurat ?? '') }}" :required="true" :readonly="$readonly">Nomor Surat</x-text-input>
            </div>
            <div></div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $medicalReport->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $medicalReport->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-4 gap-x-32 gap-y-4 my-6">
            <div>
                <x-text-input name="tinggiBadan" id="tinggiBadan" value="{{ old('tinggiBadan', $medicalReport->tinggiBadan ?? '') }}" :required="true" :readonly="$readonly">Tinggi Badan (cm)</x-text-input>
            </div>
            <div>
                <x-text-input name="denyutNadi" id="denyutNadi" value="{{ old('denyutNadi', $medicalReport->denyutNadi ?? '') }}" :required="true" :readonly="$readonly">Denyut Nadi (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="tekananDarah" id="tekananDarah" value="{{ old('tekananDarah', $medicalReport->tekananDarah ?? '') }}" :required="true" :readonly="$readonly">Tekanan Darah (mmHg)</x-text-input>
            </div>
            <div>
                <x-text-input name="spo2" id="spo2" value="{{ old('spo2', $medicalReport->spo2 ?? '') }}" :required="true" :readonly="$readonly">SPO2 (%)</x-text-input>
            </div>
            <div>
                <x-text-input name="beratBadan" id="beratBadan" value="{{ old('beratBadan', $medicalReport->beratBadan ?? '') }}" :required="true" :readonly="$readonly">Berat Badan (Kg)</x-text-input>
            </div>
            <div>
                <x-text-input name="frekuensiNafas" id="frekuensiNafas" value="{{ old('frekuensiNafas', $medicalReport->frekuensiNafas ?? '') }}" :required="true" :readonly="$readonly">Frekuensi Nafas (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="suhuBadan" id="suhuBadan" value="{{ old('suhuBadan', $medicalReport->suhuBadan ?? '') }}" :required="true" :readonly="$readonly">Suhu Badan (<span>&deg;</span>C) </x-text-input>
            </div>
            <div>
                <x-text-input name="imt" id="imt" value="{{ old('imt', $medicalReport->imt ?? '') }}" :required="true" :readonly="$readonly">IMT (kg/m<sup>2</sup>)</x-text-input>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-6">

            <div>
                <x-text-area-input label='Kondisi Klinis' id='hslPemeriksaan' name='hslPemeriksaan' value="{{ old('hslPemeriksaan', $medicalReport->hslPemeriksaan ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Rekomendasi / Saran' id='saran' name='saran' value="{{ old('saran', $medicalReport->saran ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('medicalReport.edit', ['medicalReport' => $medicalReport->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($medicalReport))
                    Update Data
                    @else
                    Tambah Data
                    @endif
                </x-blue-submit-button>
                @endif
            </div>

        </form>
    </div>
</div>

</div>
@endsection