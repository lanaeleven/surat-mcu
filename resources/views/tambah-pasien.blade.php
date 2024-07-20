@extends('layouts.main')
@section('container')

<div class="max-w-4xl mx-auto my-6">
        <div class="grid grid-cols-3">
            <div class="flex justify-start">
                <x-yellow-link-button href='/'>Kembali</x-yellow-link-button>
            </div>
            <div class="text-center">
                <x-page-header>{{ $title }}</x-page-header>
            </div>
        </div>
        <form method="post" action="/tambah-pasien">
            @csrf
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">  
                    <x-text-input name="nama" id="nama" value="" :required="true">Nama Lengkap</x-text-input>
                    <x-text-input name="noRM" id="noRM" value="" :required="true">Nomor Rekam Medis</x-text-input>
                    @php
                        $optionsJenisKelamin = [
                            ['id' => 'laki-laki', 'value' => 'Laki-Laki', 'label' => 'Laki-Laki'],
                            ['id' => 'perempuan', 'value' => 'Perempuan', 'label' => 'Perempuan'],
                        ];
                    @endphp
                    <x-radio-button-input name="jenisKelamin" checked='' :options="$optionsJenisKelamin" :required="true">Jenis Kelamin</x-radio-button-input>
                    <x-text-input name="tempatLahir" id="tempatLahir" value="" :required="true">Tempat Lahir</x-text-input>
                    <x-date-input name="tanggalLahir" id="tanggalLahir" value="" :required="true">Tanggal Lahir</x-date-input>
                    <x-text-area-input label="Alamat" value="" name="alamat" id="alamat" :required="true"></x-text-area-input>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <x-blue-submit-button>Tambah Pasien</x-blue-submit-button>
            </div>
        </form>
    </div>
@endsection