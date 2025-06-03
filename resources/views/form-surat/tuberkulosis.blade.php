@extends('layouts.main')
@section('container')
    @if (session()->has('success'))
        <x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
    @endif

    @if (session('alert'))
        <x-alert-danger>{{ session('alert') }}</x-alert-danger>
    @endif

    <div class="flex bg-white p-5 items-center rounded-lg mb-5">
        <div class="flex-none w-24">
            <x-yellow-link-button
                href="{{ route('tuberkulosis.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
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
            @if (isset($put))
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 gap-x-6 gap-y-4 mb-6">
                <input type="hidden" name="idPasien" value="{{ $pasien->id }}">
                <div>
                    <x-text-input name="noSurat" id="noSurat" value="{{ old('noSurat', $tuberkulosis->noSurat ?? '') }}"
                        :required="false" :readonly="$readonly">Nomor Surat</x-text-input>
                </div>
                <div>
                    <x-date-input name="tanggalPemeriksaan" id="tanggalPemeriksaan"
                        value="{{ old('tanggalPemeriksaan', $tuberkulosis->tanggalPemeriksaan ?? '') }}" :required="true"
                        :readonly="$readonly">Tanggal Pemeriksaan</x-date-input>
                </div>
                <div>
                    <x-dropdown-input :label="'Dokter Pemeriksa'" labelPilihan='Pilih Dokter' :name="'idDokter'" :id="'idDokter'"
                        :options="$dokter" :readonly="$readonly" :required="true"
                        selectedId="{{ old('idDokter', $tuberkulosis->dokter->id ?? '') }}"></x-dropdown-input>
                </div>
                <div>
                    <label for="hariHijriyah" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                        Hijriyah</label>
                    <div class="mt-2 flex">
                        <input type="number" name="hariHijriyah" id="hariHijriyah" placeholder="tgl"
                            value="{{ old('hariHijriyah', $tuberkulosis->hariHijriyah ?? '') }}"
                            class="block w-20 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3"
                            @if ($readonly) disabled @endif>
                        <input type="text" name="bulanHijriyah" id="bulanHijriyah" placeholder="bulan"
                            value="{{ old('bulanHijriyah', $tuberkulosis->bulanHijriyah ?? '') }}"
                            class="block w-40 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 me-3"
                            @if ($readonly) disabled @endif>
                        <input type="number" name="tahunHijriyah" id="tahunHijriyah" placeholder="tahun"
                            value="{{ old('tahunHijriyah', $tuberkulosis->tahunHijriyah ?? '') }}"
                            class="block w-24 rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            @if ($readonly) disabled @endif>
                    </div>
                </div>
                <div>
                    <x-text-input name="pekerjaanPasien" id="pekerjaanPasien"
                        value="{{ old('pekerjaanPasien', $tuberkulosis->pekerjaanPasien ?? '') }}" :required="false"
                        :readonly="$readonly">Pekerjaan Pasien</x-text-input>
                </div>

                <div>
                    <x-text-input name="keperluanSurat" id="keperluanSurat"
                        value="{{ old('keperluanSurat', $tuberkulosis->keperluanSurat ?? '') }}" :required="false"
                        :readonly="$readonly">Keperluan Surat</x-text-input>
                </div>
            </div>

            <hr>

            @php
                $optionsThorax = [
                    ['id' => 'normalThorax', 'value' => '1', 'label' => 'Dalam Batas Normal'],
                    ['id' => 'abnormalThorax', 'value' => '0', 'label' => 'Tidak Normal'],
                ];
                $optionsSputum = [
                    ['id' => 'positifSputum', 'value' => '1', 'label' => 'Positif'],
                    ['id' => 'negatifSputum', 'value' => '0', 'label' => 'Negatif'],
                ];
                $optionsKesimpulan = [
                    ['id' => 'positifKesimpulan', 'value' => '1', 'label' => 'Terindikasi'],
                    ['id' => 'negatifKesimpulan', 'value' => '0', 'label' => 'Tidak Terindikasi'],
                ];
            @endphp

            <div>
                <x-radio-button-input name="isSputum" checked="{{ old('isSputum', $tuberkulosis->isSputum ?? '') }}"
                    :options="$optionsSputum" :required="false" :readonly="$readonly">Sputum BTA SPS</x-radio-button-input>
            </div>

            <div class="mt-2">
                <x-radio-button-input name="isThorax" checked="{{ old('isThorax', $tuberkulosis->isThorax ?? '') }}"
                    :options="$optionsThorax" :required="false" :readonly="$readonly" onchange="toggleThoraxDetail()">Rontgen
                    Thorax</x-radio-button-input>
            </div>

            <div id="keteranganThorax" class="w-1/2 mb-3">
                <x-text-area-input label='' id='keteranganThorax' name='keteranganThorax'
                    value="{{ old('keteranganThorax', $tuberkulosis->keteranganThorax ?? '') }}" :required="false"
                    :readonly="$readonly"></x-text-area-input>
            </div>

            <hr>

            <div class="grid grid-cols-2 gap-x-6 gap-y-4 mt-6">
                <div>
                    <x-radio-button-input name="isTbc" checked="{{ old('isTbc', $tuberkulosis->isTbc ?? '') }}"
                        :options="$optionsKesimpulan" :required="false" :readonly="$readonly">Kesimpulan Indikasi
                        Tuberkulosis</x-radio-button-input>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-start gap-x-6">
                @if ($readonly)
                    <x-yellow-link-button
                        href="{{ route('tuberkulosis.edit', ['tuberkulosis' => $tuberkulosis->id]) }}">Edit
                        Data</x-yellow-link-button>
                    <x-green-submit-button>Buat Surat</x-green-submit-button>
                @else
                    <x-blue-submit-button>
                        @if (isset($tuberkulosis))
                            Update Data
                        @else
                            Tambah Data
                        @endif
                    </x-blue-submit-button>
                @endif
            </div>

        </form>
    </div>

    <script>
        const abnormalRadio = document.getElementById('abnormalThorax');
        const normalRadio = document.getElementById('normalThorax');
        const keteranganThorax = document.getElementById('keteranganThorax');

        function toggleThoraxDetail() {
            if (abnormalRadio.checked) {
                keteranganThorax.style.display = 'block';
            } else {
                keteranganThorax.style.display = 'none';
            }
        }

        // Jalankan saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            toggleThoraxDetail(); // Periksa nilai saat awal load
        });

        // Event listener untuk perubahan
        abnormalRadio.addEventListener('change', toggleThoraxDetail);
        normalRadio.addEventListener('change', toggleThoraxDetail);
    </script>
@endsection
