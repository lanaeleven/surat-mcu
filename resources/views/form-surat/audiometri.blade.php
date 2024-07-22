@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="grid grid-cols-3 mb-6">
    <div>
        <div><x-yellow-link-button href="{{ route('audiometri.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button></div>
    </div>
    <div>
        <x-page-header>{{ $title }}</x-page-header>
    </div>
</div>

<div class="grid grid-cols-2 w-1/3 mx-auto">
    <div>Nama</div>
    <div>: {{ $pasien->nama }}</div>
    <div>TTL</div>
    <div>: {{ $pasien->tempatLahir }}, {{ $pasien->tanggalLahir }}</div>
    <div>Jenis Kelamin</div>
    <div>: {{ $pasien->jenisKelamin }}</div>
    <div>Alamat</div>
    <div>: {{ $pasien->alamat }}</div>
    <div>Nomor RM</div>
    <div>: {{ $pasien->noRM }}</div>
</div>
<br>
<hr>
<br><br>
<div class="max-w-4xl mx-auto mb-7">
    <form action="{{ $action }}" method="post" @if (isset($blank)) target="_blank" @endif>
        @csrf
        @if(isset($put))
            @method('PUT')
        @endif
        <input type="hidden" name="idPasien" value="{{ $pasien->id }}" >
        <x-text-area-input label='Hasil Pemeriksaan' id='hslPemeriksaan' name='hslPemeriksaan' value="{{ old('hslPemeriksaan', $audiometri->hslPemeriksaan ?? '') }}" :required="true" 
        :readonly="$readonly" ></x-text-area-input>
        <br>
        <x-text-area-input label='Kesimpulan' id='kesimpulan' name='kesimpulan' value="{{ old('kesimpulan', $audiometri->kesimpulan ?? '') }}" :required="true" :readonly="$readonly"></x-text-area-input>
        <div class="mt-3">
            {{-- @if ($readonly) --}}
            {{-- <div>Dokter Pemeriksa: {{ $dokter->nama }}</div>          --}}
            {{-- @else --}}
            <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $audiometri->dokter->id ?? '') }}"></x-dropdown-input>
            {{-- @endif --}}
        </div>
        <div class="mt-6 flex items-center justify-center gap-x-6">
            @if ($readonly)
            <x-yellow-link-button href="{{ route('audiometri.edit', ['audiometri' => $audiometri->id]) }}">Edit Data</x-yellow-link-button>
            <x-green-submit-button>Buat Surat</x-green-submit-button>
            @else
            <x-blue-submit-button>
                @if (isset($audiometri))
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
@endsection