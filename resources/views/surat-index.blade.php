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
            <x-card-surat gambar='/images/audiometri.png' href="{{ route('audiometri.index', ['pasien' => $pasien->id]) }}">Pemeriksaan Audiometri</x-card-surat>
        </div>
    </div>
</div>

    
@endsection