@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="grid grid-cols-3 mb-6">
    <div><x-yellow-link-button href='/'>Kembali</x-yellow-link-button></div>
    <div class="text-center">
        <x-page-header>{{ $title }}</x-page-header>
    </div>
    <div></div>
</div>
<div class="flex justify-start mb-6">
    <div>
        <x-page-header>{{ $pasien->nama }} ({{ $pasien->noRM }})</x-page-header>
    </div>
</div>

<div class="grid grid-cols-5 gap-4 mb-6">
    <div>
        <x-card href="{{ route('audiometri.index', ['pasien' => $pasien->id]) }}">Pemeriksaan Audiometri</x-card>
    </div>
    <div>
    </div>
    <div>
    </div>
</div>
    
@endsection