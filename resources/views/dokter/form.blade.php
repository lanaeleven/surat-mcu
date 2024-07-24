@extends('layouts.main')
@section('container')

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('dokter.index') }}">Kembali</x-yellow-link-button>
    </div>
    <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg my-6">
        <form action="{{ isset($dokter) ? route('dokter.update', $dokter->id) : route('dokter.store') }}" method="POST" >
        @csrf
        @if(isset($dokter))
            @method('PUT')
        @endif
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-4">  
                    <div>
                        <x-text-input name="nama" id="nama" value="{{ old('nama', $dokter->nama ?? '') }}" :required="true" :readonly="$readonly">Nama Lengkap</x-text-input>
                        @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-text-input name="sip" id="sip" value="{{ old('sip', $dokter->sip ?? '') }}" :required="true" :readonly="$readonly">Nomor SIP</x-text-input>
                        @error('sip')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="mt-6 flex items-center justify-center gap-x-6">
                <x-blue-submit-button>{{ isset($dokter) ? 'Update Dokter' : 'Tambah Dokter' }}</x-blue-submit-button>
            </div>
        </form>
    </div>
@endsection