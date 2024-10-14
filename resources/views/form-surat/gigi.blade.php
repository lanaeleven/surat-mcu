@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

@if (session('alert'))
<x-alert-danger>{{ session('alert') }}</x-alert-danger>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('gigi.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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
                <div class="flex-none w-44">Jenis Kelamin</div>
                <div class="flex-none w-2">:</div>
                <div class="flex-auto">{{ $pasien->jenisKelamin }}</div>
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
        <input type="hidden" name="idPasien" value="{{ $pasien->id }}">
        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mb-6">
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $gigi->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $gigi->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
        </div>

        <hr>

        @php
            $optionskarangAtas = [
                ['id' => 'adakarangAtas', 'value' => '1', 'label' => 'Ada'],
                ['id' => 'tidakAdakarangAtas', 'value' => '0', 'label' => 'Tidak Ada'],
            ];

            $optionskarangBawah = [
                ['id' => 'adakarangBawah', 'value' => '1', 'label' => 'Ada'],
                ['id' => 'tidakAdakarangBawah', 'value' => '0', 'label' => 'Tidak Ada'],
            ];
        @endphp

        <div class="grid grid-cols-4 gap-x-32 gap-y-4 my-6">
            <div>
                <x-radio-button-input name="karangAtas" checked="{{ old('karangAtas', $gigi->karangAtas ?? '') }}" :options="$optionskarangAtas" :required="false" :readonly="$readonly">Karang Gigi (Rahang Atas)</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="karangBawah" checked="{{ old('karangBawah', $gigi->karangBawah ?? '') }}" :options="$optionskarangBawah" :required="false" :readonly="$readonly">Karang Gigi (Rahang Bawah)</x-radio-button-input>
            </div>
            <div></div>
            <div></div>
            <div>
                <x-text-input name="decay" id="decay" value="{{ old('decay', $gigi->decay ?? '') }}" :required="false" :readonly="$readonly">Jml Decay/Gigi Berlubang</x-text-input>
            </div>
            <div>
                <x-text-input name="missing" id="missing" value="{{ old('missing', $gigi->missing ?? '') }}" :required="false" :readonly="$readonly">Jml Missing/Gigi yang hilang</x-text-input>
            </div>
            <div>
                <x-text-input name="filling" id="filling" value="{{ old('filling', $gigi->filling ?? '') }}" :required="false" :readonly="$readonly">Jml Filling/Gigi tambahan</x-text-input>
            </div>
            <div>
                <x-text-input name="sisaAkar" id="sisaAkar" value="{{ old('sisaAkar', $gigi->sisaAkar ?? '') }}" :required="false" :readonly="$readonly">Jml sisa akar</x-text-input>
            </div>
            
        </div>

        <hr>

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-6">
            <div>
                <x-text-area-input label='Pemeriksaan Jaringan Lunak' id='jaringanLunak' name='jaringanLunak' value="{{ old('jaringanLunak', $gigi->jaringanLunak ?? '') }}" :required="false" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Kesimpulan & Saran' id='kesimpulan' name='kesimpulan' value="{{ old('kesimpulan', $gigi->kesimpulan ?? '') }}" :required="false" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Lainnya' id='lainnya' name='lainnya' value="{{ old('lainnya', $gigi->lainnya ?? '') }}" :required="false" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('gigi.edit', ['gigi' => $gigi->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($gigi))
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