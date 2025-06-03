@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('pasien.index') }}">Kembali</x-yellow-link-button>
    </div>
    <div class="flex-auto"><x-page-header>{{ $title }} - {{ $pasien->nama }} ({{ $pasien->noRM }})</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">
    <div class="grid grid-cols-5 gap-4 mb-6">
        <div>
            <x-card-surat :lengkap="true" gambar='/images/audiometri.png' href="{{ route('audiometri.index', ['pasien' => $pasien->id]) }}" :exist="$audiometriCount"  >Audiometri</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/spirometri.png' href="{{ route('spirometri.index', ['pasien' => $pasien->id]) }}" :exist="$spirometriCount">Spirometri</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/vaksinasi.png' href="{{ route('vaksinasi.index', ['pasien' => $pasien->id]) }}" :exist="$vaksinasiCount">Vaksinasi</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/gizi.png' href="{{ route('gizi.index', ['pasien' => $pasien->id]) }}" :exist="$giziCount">Gizi</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/medical-report.png' href="{{ route('medicalReport.index', ['pasien' => $pasien->id]) }}" :exist="$medicalReportCount">Medical Report</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/gigi.png' href="{{ route('gigi.index', ['pasien' => $pasien->id]) }}" :exist="$gigiCount">Gigi</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/screening.png' href="{{ route('screening.index', ['pasien' => $pasien->id]) }}" :exist="$screeningCount">Screening</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/kesehatan-badan.png' href="{{ route('kesehatanBadan.index', ['pasien' => $pasien->id]) }}" :exist="$kesehatanBadanCount">Kesehatan Badan</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/narkotika.png' href="{{ route('narkotika.index', ['pasien' => $pasien->id]) }}" :exist="$narkotikaCount">Narkotika</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/treadmill.png' href="{{ route('treadmill.index', ['pasien' => $pasien->id]) }}" :exist="$treadmillCount">Treadmill</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/tbc.png' href="{{ route('tuberkulosis.index', ['pasien' => $pasien->id]) }}" :exist="$tuberkulosisCount">Tuberkulosis</x-card-surat>
        </div>
        <div>
            <x-card-surat :lengkap="true" gambar='/images/hepatiA.png' href="{{ route('hepatia.index', ['pasien' => $pasien->id]) }}" :exist="$hepatiaCount">Hepatitis A</x-card-surat>
        </div>
    </div>
</div>

    
@endsection