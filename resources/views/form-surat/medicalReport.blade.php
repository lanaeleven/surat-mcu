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
        <x-yellow-link-button href="{{ route('medicalReport.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mb-6">
            <input type="hidden" name="idPasien" value="{{ $pasien->id }}" >
            <div>
                <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $medicalReport->noSurat ?? '') }}" :required="false" :readonly="$readonly">Nomor Surat</x-text-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $medicalReport->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $medicalReport->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <label for="hariHijriyah" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Hijriyah</label>
            <div class="mt-2 flex">
            <input type="number" name="hariHijriyah" id="hariHijriyah" placeholder="tgl" value="{{ old('hariHijriyah', $medicalReport->hariHijriyah ?? '') }}" class="block w-20 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            
            @if ($readonly) disabled @endif 
            >
            <input type="text" name="bulanHijriyah" id="bulanHijriyah" placeholder="bulan" value="{{ old('bulanHijriyah', $medicalReport->bulanHijriyah ?? '') }}" class="block w-40 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            
            @if ($readonly) disabled @endif 
            >
            <input type="number" name="tahunHijriyah" id="tahunHijriyah" placeholder="tahun" value="{{ old('tahunHijriyah', $medicalReport->tahunHijriyah ?? '') }}" class="block w-24 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
            
            @if ($readonly) disabled @endif 
            >
            </div>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-4 gap-x-32 gap-y-4 my-6">
            <div>
                <x-text-input name="tinggiBadan" id="tinggiBadan" value="{{ old('tinggiBadan', $medicalReport->tinggiBadan ?? '') }}" :required="false" :readonly="$readonly">Tinggi Badan (cm)</x-text-input>
            </div>
            <div>
                <x-text-input name="denyutNadi" id="denyutNadi" value="{{ old('denyutNadi', $medicalReport->denyutNadi ?? '') }}" :required="false" :readonly="$readonly">Denyut Nadi (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="tekananDarah" id="tekananDarah" value="{{ old('tekananDarah', $medicalReport->tekananDarah ?? '') }}" :required="false" :readonly="$readonly">Tekanan Darah (mmHg)</x-text-input>
            </div>
            <div>
                <x-text-input name="spo2" id="spo2" value="{{ old('spo2', $medicalReport->spo2 ?? '') }}" :required="false" :readonly="$readonly">SPO2 (%)</x-text-input>
            </div>
            <div>
                <x-text-input name="beratBadan" id="beratBadan" value="{{ old('beratBadan', $medicalReport->beratBadan ?? '') }}" :required="false" :readonly="$readonly">Berat Badan (Kg)</x-text-input>
            </div>
            <div>
                <x-text-input name="frekuensiNafas" id="frekuensiNafas" value="{{ old('frekuensiNafas', $medicalReport->frekuensiNafas ?? '') }}" :required="false" :readonly="$readonly">Frekuensi Nafas (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="suhuBadan" id="suhuBadan" value="{{ old('suhuBadan', $medicalReport->suhuBadan ?? '') }}" :required="false" :readonly="$readonly">Suhu Badan (<span>&deg;</span>C) </x-text-input>
            </div>
            <div>
                <x-text-input name="imt" id="imt" value="{{ old('imt', $medicalReport->imt ?? '') }}" :required="false" :readonly="$readonly">IMT (kg/m<sup>2</sup>)</x-text-input>
            </div>
        </div>

        <hr>

        @php
            $optionsStatus = [
                ['id' => '1a', 'value' => '1a', 'label' => '1a - Fit, tidak dijumpai problem kesehatan'],
                ['id' => '1b', 'value' => '1b', 'label' => '1b - Fit, dijumpai problem kesehatan yang tidak serius'],
                ['id' => '2', 'value' => '2', 'label' => '2 - Fit, dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Ringan)'],
                ['id' => '3a', 'value' => '3a', 'label' => '3a - Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Sedang)'],
                ['id' => '3b', 'value' => '3b', 'label' => '3b - Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Tinggi)'],
                ['id' => '4', 'value' => '4', 'label' => '4 - Unfit, dengan keterbatasan fisik untuk melakukan pekerjaan secara Normal hanya untuk pekerjaan ringan'],
                ['id' => '5', 'value' => '5', 'label' => '5 - Unfit, sedang sakit, perawatan rumah sakit atau dalam kondisi yang tidak memungkinkan untuk melakukan pekerjaan (Status izin sakit)'],
            ];
        @endphp

        <div class="mt-6">
            <x-radio-button-input name="status" checked="{{ old('status', $medicalReport->status ?? '') }}" :options="$optionsStatus" :required="false" :readonly="$readonly">Status</x-radio-button-input>
        </div>

        

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-3">

            <div>
                <x-text-area-input label='Kondisi Klinis' id='hslPemeriksaan' name='hslPemeriksaan' value="{{ old('hslPemeriksaan', $medicalReport->hslPemeriksaan ?? '') }}" :required="false" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
            <div>
                <x-text-area-input label='Rekomendasi / Saran' id='saran' name='saran' value="{{ old('saran', $medicalReport->saran ?? '') }}" :required="false" 
                :readonly="$readonly" ></x-text-area-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('medicalReport.edit', ['medicalReport' => $medicalReport->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($medicalReport))
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