@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('spirometri.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
    </div>
    <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">
    
    <div class="flex justify-start">
        <div class="flex-row">
            <div class="flex">
                <div class="flex-none w-44">No. Rekam Medis</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->noRM }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">Nama</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->nama }}</div>
            </div>
            <div class="flex">
                <div class="flex-none w-44">Umur</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $umur }} tahun</div>
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
        </div>
    </div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">

    <form action="{{ $action }}" method="post" @if (isset($blank)) target="_blank" @endif>
        @csrf
        @if(isset($put))
        @method('PUT')
        @endif

        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <input type="hidden" name="idPasien" value="{{ $pasien->id }}" >
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $spirometri->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $spirometri->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-text-area-input label='Diagnosa Awal' id='diagAwal' name='diagAwal' value="{{ old('diagAwal', $spirometri->diagAwal ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Hasil Pemeriksaan' id='hslPemeriksaan' name='hslPemeriksaan' value="{{ old('hslPemeriksaan', $spirometri->hslPemeriksaan ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Kesimpulan' id='kesimpulan' name='kesimpulan' value="{{ old('kesimpulan', $spirometri->kesimpulan ?? '') }}" :required="true" :readonly="$readonly"></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Saran' id='saran' name='saran' value="{{ old('saran', $spirometri->saran ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('spirometri.edit', ['spirometri' => $spirometri->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($spirometri))
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