@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('narkotika.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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
                <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $narkotika->noSurat ?? '') }}" :required="true" :readonly="$readonly">Nomor Surat</x-text-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $narkotika->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $narkotika->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <label for="hariHijriyah" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Hijriyah</label>
            <div class="mt-2 flex">
            <input type="number" name="hariHijriyah" id="hariHijriyah" placeholder="tgl" value="{{ old('hariHijriyah', $narkotika->hariHijriyah ?? '') }}" class="block w-20 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            required
            @if ($readonly) disabled @endif 
            >
            <input type="text" name="bulanHijriyah" id="bulanHijriyah" placeholder="bulan" value="{{ old('bulanHijriyah', $narkotika->bulanHijriyah ?? '') }}" class="block w-40 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            required
            @if ($readonly) disabled @endif 
            >
            <input type="number" name="tahunHijriyah" id="tahunHijriyah" placeholder="tahun" value="{{ old('tahunHijriyah', $narkotika->tahunHijriyah ?? '') }}" class="block w-24 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
            required
            @if ($readonly) disabled @endif 
            >
            </div>
            </div>
            <div>
                <x-text-input name="pekerjaanPasien" id="pekerjaanPasien" value="{{ old('pekerjaanPasien', $narkotika->pekerjaanPasien ?? '') }}" :required="true" :readonly="$readonly">Pekerjaan Pasien</x-text-input>
            </div>
            
            <div>
                <x-text-input name="keperluanSurat" id="keperluanSurat" value="{{ old('keperluanSurat', $narkotika->keperluanSurat ?? '') }}" :required="true" :readonly="$readonly">Keperluan Surat</x-text-input>
            </div>
            <div>
                <x-text-area-input label='Hasil Wawancara DAST-10 ASSIST' id='hslWawancara' name='hslWawancara' value="{{ old('hslWawancara', $narkotika->hslWawancara ?? '') }}" :required="true" 
                    :readonly="$readonly" ></x-text-area-input>
            </div>
            </div>

        <hr>

        <div class="grid grid-cols-6 gap-y-4 my-6">
            

            @php
            $optionsCoccaine = [
                ['id' => 'positifCoccaine', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifCoccaine', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsMethamphetamine = [
                ['id' => 'positifMethamphetamine', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifMethamphetamine', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsMorphin = [
                ['id' => 'positifMorphin', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifMorphin', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsMarijuana = [
                ['id' => 'positifMarijuana', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifMarijuana', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsBenzodiazepines = [
                ['id' => 'positifBenzodiazepines', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifBenzodiazepines', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsAmphetamine = [
                ['id' => 'positifAmphetamine', 'value' => '1', 'label' => 'Positif'],
                ['id' => 'negatifAmphetamine', 'value' => '0', 'label' => 'Negatif'],
            ];
            $optionsKesimpulan = [
                ['id' => 'positifKesimpulan', 'value' => '1', 'label' => 'Terindikasi'],
                ['id' => 'negatifKesimpulan', 'value' => '0', 'label' => 'Tidak Terindikasi'],
            ];
            @endphp
            <div>
                <x-radio-button-input name="coccaine" checked="{{ old('coccaine', $narkotika->coccaine ?? '') }}" :options="$optionsCoccaine" :required="true" :readonly="$readonly">Coccaine</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="methamphetamine" checked="{{ old('methamphetamine', $narkotika->methamphetamine ?? '') }}" :options="$optionsMethamphetamine" :required="true" :readonly="$readonly">Methamphetamine</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="morphin" checked="{{ old('morphin', $narkotika->morphin ?? '') }}" :options="$optionsMorphin" :required="true" :readonly="$readonly">Morphin</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="marijuana" checked="{{ old('marijuana', $narkotika->marijuana ?? '') }}" :options="$optionsMarijuana" :required="true" :readonly="$readonly">Marijuana</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="benzodiazepines" checked="{{ old('benzodiazepines', $narkotika->benzodiazepines ?? '') }}" :options="$optionsBenzodiazepines" :required="true" :readonly="$readonly">Benzodiazepines</x-radio-button-input>
            </div>
            <div>
                <x-radio-button-input name="amphetamine" checked="{{ old('amphetamine', $narkotika->amphetamine ?? '') }}" :options="$optionsAmphetamine" :required="true" :readonly="$readonly">Amphetamine</x-radio-button-input>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-6">
            <div>
                <x-radio-button-input name="kesimpulan" checked="{{ old('kesimpulan', $narkotika->kesimpulan ?? '') }}" :options="$optionsKesimpulan" :required="true" :readonly="$readonly">Kesimpulan Indikasi Penggunaan Narkotika</x-radio-button-input>
            </div>
        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('narkotika.edit', ['narkotika' => $narkotika->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($narkotika))
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