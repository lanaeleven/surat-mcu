@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex justify-center mb-6">
    <div>
        <x-page-header>{{ $title }}</x-page-header>
    </div>
</div>

<div class="flex justify-center mb-6">
    <div>
        <p>
            Nama/Name: <b>{{ $pasien->nama }}</b> 
        </p>
        <p>
            TTL/Date Of Birth/ Umur/ Age: <b>{{ $pasien->tempatLahir }}, {{ $pasien->tanggalLahir }}</b> 
        </p>
        <p>
            Jenis Kelamin: <b>{{ $pasien->jenisKelamin }}</b>
        </p>
        <p>
            Alamat / Address: <b>{{ $pasien->alamat }}</b>
        </p>
        <p>
            No RM: <b>{{ $pasien->noRM }}</b>
        </p>
    </div>
</div>
<hr>
<br><br>
<div class="max-w-4xl mx-auto mb-7">
    <form action="/generate/audiometri" method="post" target="_blank">
        @csrf
        {{-- <p>Berdasarkan hasil pemeriksaan, ditemukan: </p> --}}
        <input type="hidden" name="idPasien" value="{{ $pasien->id }}">
        <x-text-area-input label='Hasil Pemeriksaan' id='hslPemeriksaan' name='hslPemeriksaan' value='' :required="true"></x-text-area-input>
        <br>
        <x-text-area-input label='Kesimpulan' id='kesimpulan' name='kesimpulan' value='' :required="true"></x-text-area-input>
        {{-- <p>Terima kasih atas kepercayaan Anda bekerja sama dengan Rumah Sakit Islam Sultan Agung Banjarbaru.</p> --}}
        <div class="mt-3">
        <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :required="true"></x-dropdown-input>
        </div>
        <div class="mt-6 flex items-center justify-center gap-x-6">
            <x-blue-submit-button>Buat Surat</x-blue-submit-button>
        </div>
    </form>
</div>

</div>
@endsection