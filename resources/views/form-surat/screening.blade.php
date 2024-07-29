@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('screening.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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
                <div class="flex-none w-44">Umur</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $umur }}</div>
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

        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <input type="hidden" name="idPasien" value="{{ $pasien->id }}" >
            <div>
                <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $screening->noSurat ?? '') }}" :required="true" :readonly="$readonly">Nomor Surat</x-text-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $screening->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $screening->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <x-text-input name="dokterSpesialis" id="dokterSpesialis" value="{{ old('dokterSpesialis', $screening->dokterSpesialis ?? '') }}" :required="true" :readonly="$readonly">Spesialisasi Dokter</x-text-input>
            </div>
            <div>
                <x-text-input name="jenisScreening" id="jenisScreening" value="{{ old('jenisScreening', $screening->jenisScreening ?? '') }}" :required="true" :readonly="$readonly">Jenis Screening</x-text-input>
            </div>
            <div>
                <x-text-area-input label='Kondisi Klinis' id='hslPemeriksaan' name='hslPemeriksaan' value="{{ old('hslPemeriksaan', $screening->hslPemeriksaan ?? '') }}" :required="true" 
                :readonly="$readonly" ></x-text-area-input>
            </div>

            @php
            $optionsStatusKesehatan = [
                ['id' => 'sehat', 'value' => 'SEHAT', 'label' => 'SEHAT'],
                ['id' => 'tidak_sehat', 'value' => 'TIDAK SEHAT', 'label' => 'TIDAK SEHAT'],
            ];
            @endphp
            <div>
                <x-radio-button-input name="statusKesehatan" checked="{{ old('statusKesehatan', $screening->statusKesehatan ?? '') }}" :options="$optionsStatusKesehatan" :required="true" :readonly="$readonly">Status Kesehatan</x-radio-button-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('screening.edit', ['screening' => $screening->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($screening))
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