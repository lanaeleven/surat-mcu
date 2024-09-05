@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
    <div class="flex-none w-24">
        <x-yellow-link-button href="{{ route('kesehatanBadan.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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
                <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $kesehatanBadan->noSurat ?? '') }}" :required="true" :readonly="$readonly">Nomor Surat</x-text-input>
            </div>
            <div>
                <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan" value="{{ old('tanggalPemeriksaan', $kesehatanBadan->tanggalPemeriksaan ?? '') }}" :required="true" :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
            </div>
            <div>
                <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'" :options="$dokter" :readonly="$readonly" :required="true" selectedId="{{ old('idDokter', $kesehatanBadan->dokter->id ?? '') }}"></x-dropdown-input>
            </div>
            <div>
                <label for="hariHijriyah" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Hijriyah</label>
            <div class="mt-2 flex">
            <input type="number" name="hariHijriyah" id="hariHijriyah" placeholder="tgl" value="{{ old('hariHijriyah', $kesehatanBadan->hariHijriyah ?? '') }}" class="block w-20 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            required
            @if ($readonly) disabled @endif 
            >
            <input type="text" name="bulanHijriyah" id="bulanHijriyah" placeholder="bulan" value="{{ old('bulanHijriyah', $kesehatanBadan->bulanHijriyah ?? '') }}" class="block w-40 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3" 
            required
            @if ($readonly) disabled @endif 
            >
            <input type="number" name="tahunHijriyah" id="tahunHijriyah" placeholder="tahun" value="{{ old('tahunHijriyah', $kesehatanBadan->tahunHijriyah ?? '') }}" class="block w-24 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
            required
            @if ($readonly) disabled @endif 
            >
            </div>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-4 gap-x-32 gap-y-4 my-6">
            <div>
                <x-text-input name="tinggiBadan" id="tinggiBadan" value="{{ old('tinggiBadan', $kesehatanBadan->tinggiBadan ?? '') }}" :required="true" :readonly="$readonly">Tinggi Badan (cm)</x-text-input>
            </div>
            <div>
                <x-text-input name="denyutNadi" id="denyutNadi" value="{{ old('denyutNadi', $kesehatanBadan->denyutNadi ?? '') }}" :required="true" :readonly="$readonly">Denyut Nadi (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="tekananDarah" id="tekananDarah" value="{{ old('tekananDarah', $kesehatanBadan->tekananDarah ?? '') }}" :required="true" :readonly="$readonly">Tekanan Darah (mmHg)</x-text-input>
            </div>
            <div>
                <x-text-input name="spo2" id="spo2" value="{{ old('spo2', $kesehatanBadan->spo2 ?? '') }}" :required="true" :readonly="$readonly">SPO2 (%)</x-text-input>
            </div>
            <div>
                <x-text-input name="beratBadan" id="beratBadan" value="{{ old('beratBadan', $kesehatanBadan->beratBadan ?? '') }}" :required="true" :readonly="$readonly">Berat Badan (Kg)</x-text-input>
            </div>
            <div>
                <x-text-input name="frekuensiNafas" id="frekuensiNafas" value="{{ old('frekuensiNafas', $kesehatanBadan->frekuensiNafas ?? '') }}" :required="true" :readonly="$readonly">Frekuensi Nafas (x/menit)</x-text-input>
            </div>
            <div>
                <x-text-input name="suhuBadan" id="suhuBadan" value="{{ old('suhuBadan', $kesehatanBadan->suhuBadan ?? '') }}" :required="true" :readonly="$readonly">Suhu Badan (<span>&deg;</span>C) </x-text-input>
            </div>
            <div>
                <x-text-input name="imt" id="imt" value="{{ old('imt', $kesehatanBadan->imt ?? '') }}" :required="true" :readonly="$readonly">IMT (kg/m<sup>2</sup>)</x-text-input>
            </div>
        </div>

        <hr>

        <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-6">

            <div>
                <x-text-input name="keperluanSurat" id="keperluanSurat" value="{{ old('keperluanSurat', $kesehatanBadan->keperluanSurat ?? '') }}" :required="true" :readonly="$readonly">Keperluan Surat</x-text-input>
            </div>

            <div>
                <div class="col-span-full">
                    <fieldset>
                        <legend class="text-sm font-semibold leading-6 text-gray-900">Status Kesehatan</legend>
                        <div class="flex items-center mt-2">
                            <input type="hidden" name="sehat" value="0">
                            <input id="sehat" name="sehat" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($readonly) disabled @endif
                            @isset($kesehatanBadan)
                            @if ($kesehatanBadan->sehat) checked @endif
                            @endisset>
                            <label for="sehat" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sehat</label>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="hidden" name="sakit" value="0">
                            <input id="sakit" name="sakit" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($readonly) disabled @endif 
                            @isset($kesehatanBadan)
                            @if ($kesehatanBadan->sakit) checked @endif
                            @endisset>
                            <label for="sakit" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sakit</label>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="hidden" name="cacat" value="0">
                            <input id="cacat" name="cacat" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($readonly) disabled @endif 
                            @isset($kesehatanBadan)
                            @if ($kesehatanBadan->cacat) checked @endif
                            @endisset>
                            <label for="cacat" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cacat</label>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="hidden" name="tidakCacat" value="0">
                            <input id="tidakCacat" name="tidakCacat" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($readonly) disabled @endif 
                            @isset($kesehatanBadan)
                            @if ($kesehatanBadan->tidakCacat) checked @endif
                            @endisset>
                            <label for="tidakCacat" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak Cacat</label>
                        </div>
                    </fieldset>
                </div>
            </div>

        </div>
            
            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                <x-yellow-link-button href="{{ route('kesehatanBadan.edit', ['kesehatanBadan' => $kesehatanBadan->id]) }}">Edit Data</x-yellow-link-button>
                <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                <x-blue-submit-button>
                    @if (isset($kesehatanBadan))
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