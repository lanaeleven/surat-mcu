@extends('layouts.main')
@section('container')
{{-- @dd($pasien->jenisKelamin); --}}
<div class="max-w-4xl mx-auto my-6">
        <div class="grid grid-cols-3">
            <div class="flex justify-start">
                <x-yellow-link-button href="{{ route('pasien.index') }}">Kembali</x-yellow-link-button>
            </div>
            <div class="text-center">
                <x-page-header>{{ $title }}</x-page-header>
            </div>
        </div>
        <form action="{{ isset($pasien) ? route('pasien.update', $pasien->id) : route('pasien.store') }}" method="POST" >
        @csrf
        @if(isset($pasien))
            @method('PUT')
        @endif
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">  
                    <x-text-input name="nama" id="nama" value="{{ old('nama', $pasien->nama ?? '') }}" :required="true">Nama Lengkap</x-text-input>
                    @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <x-text-input name="noRM" id="noRM" value="{{ old('noRM', $pasien->noRM ?? '') }}" :required="true">Nomor Rekam Medis</x-text-input>
                    @error('noRM')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @php
                        $optionsJenisKelamin = [
                            ['id' => 'laki-laki', 'value' => 'Laki-Laki', 'label' => 'Laki-Laki'],
                            ['id' => 'perempuan', 'value' => 'Perempuan', 'label' => 'Perempuan'],
                        ];
                    @endphp
                    <x-radio-button-input name="jenisKelamin" checked="{{ old('jenisKelamin', $pasien->jenisKelamin ?? '') }}" :options="$optionsJenisKelamin" :required="true">Jenis Kelamin</x-radio-button-input>
                    @error('jenisKelamin')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <x-text-input name="tempatLahir" id="tempatLahir" value="{{ old('tempatLahir', $pasien->tempatLahir ?? '') }}" :required="true">Tempat Lahir</x-text-input>
                    @error('tempatLahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <x-date-input name="tanggalLahir" id="tanggalLahir" value="{{ old('tanggalLahir', $pasien->tanggalLahir ?? '') }}" :required="true">Tanggal Lahir</x-date-input>
                    @error('tanggalLahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <x-text-area-input label="Alamat" value="{{ old('alamat', $pasien->alamat ?? '') }}" name="alamat" id="alamat" :required="true" :readonly="$readonly"></x-text-area-input>
                    @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <x-blue-submit-button>{{ isset($pasien) ? 'Update Pasien' : 'Tambah Pasien' }}</x-blue-submit-button>
            </div>
        </form>
    </div>
@endsection