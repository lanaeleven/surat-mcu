@extends('layouts.main')
@section('container')
    <div class="flex justify-center">
        <x-page-header>{{ $title }}</x-page-header>
    </div>
    <div class="max-w-4xl mx-auto my-6">
        <div class="flex justify-start">
            <x-yellow-link-button href='/'>Kembali</x-yellow-link-button>
        </div>
        <form method="post" action="/edit-pasien">
            @csrf
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">  
                    <x-text-input name="nama" id="nama" :required="true" :value="$pasien->nama">Nama Lengkap</x-text-input>
                    <x-text-input name="noRM" id="noRM" :required="true" :value="$pasien->noRM">Nomor Rekam Medis</x-text-input>
                    @php
                        $optionsJenisKelamin = [
                            ['id' => 'laki-laki', 'value' => 'Laki-Laki', 'label' => 'Laki-Laki'],
                            ['id' => 'perempuan', 'value' => 'Perempuan', 'label' => 'Perempuan'],
                        ];
                    @endphp
                    <x-radio-button-input :checked="$pasien->jenisKelamin" name="jenisKelamin" :options="$optionsJenisKelamin" :required="true">Jenis Kelamin</x-radio-button-input>
                    <x-text-input name="tempatLahir" id="tempatLahir" :required="true" :value="$pasien->tempatLahir" >Tempat Lahir</x-text-input>
                    <x-date-input name="tanggalLahir" id="tanggalLahir" :required="true" :value="$pasien->tanggalLahir">Tanggal Lahir</x-date-input>
                    <x-text-area-input label="Alamat" name="alamat" id="alamat" :value="$pasien->alamat" :required="true" :value="$pasien->alamat"></x-text-area-input>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <x-blue-submit-button>Simpan</x-blue-submit-button>
            </div>
        </form>
    </div>
@endsection