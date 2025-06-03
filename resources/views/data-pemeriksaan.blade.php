@extends('layouts.main')
@section('container')
{{-- @dd($jenisPemeriksaan) --}}
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
  <div class="flex-none w-24">
      <x-yellow-link-button href="{{ route('surat.index', ['pasien' => $pasien->id]) }}">Kembali</x-yellow-link-button>
  </div>
  <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg">
  
  <div class="flex justify-end">
    <div><x-green-link-button href="{{ $routeCreate }}">Tambah Data</x-green-link-button></div>
  </div>

  @if ($dataPemeriksaan->isEmpty())
      <h3 class="text-center text-xl">Tidak terdapat data pemeriksaan</h3>
  @else
  <div class="mt-5">
    <x-table :headers="['Pasien', 'Dokter Pemeriksa', 'Tanggal Pemeriksaan', 'Tanggal Terakhir diedit', 'Aksi']">
      @foreach ($dataPemeriksaan as $dp)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-600">
        <td class="px-6 py-4">
          {{ $dp->pasien->nama }} ({{ $dp->pasien->noRM }})
        </td>
        <td class="px-6 py-4">
          {{ $dp->dokter->nama }}
        </td>   
        <td class="px-6 py-4">
          {{ $dp->tanggalPemeriksaan }}
        </td>      
        <td class="px-6 py-4">
          {{ $dp->updated_at }}
        </td>      
        <td class="px-6 py-4 min-w-[200px]">
          
          @php
              if ($jenisPemeriksaan == 'audiometri') {
                $routeCetak = route('audiometri.show', ['audiometri' => $dp->id]);
                $routeHapus = route('audiometri.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'spirometri') {
                $routeCetak = route('spirometri.show', ['spirometri' => $dp->id]);
                $routeHapus = route('spirometri.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'vaksinasi') {
                $routeCetak = route('vaksinasi.show', ['vaksinasi' => $dp->id]);
                $routeHapus = route('vaksinasi.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'gizi') {
                $routeCetak = route('gizi.show', ['gizi' => $dp->id]);
                $routeHapus = route('gizi.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'medicalReport') {
                $routeCetak = route('medicalReport.show', ['medicalReport' => $dp->id]);
                $routeHapus = route('medicalReport.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'screening') {
                $routeCetak = route('screening.show', ['screening' => $dp->id]);
                $routeHapus = route('screening.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'kesehatanBadan') {
                $routeCetak = route('kesehatanBadan.show', ['kesehatanBadan' => $dp->id]);
                $routeHapus = route('kesehatanBadan.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'narkotika') {
                $routeCetak = route('narkotika.show', ['narkotika' => $dp->id]);
                $routeHapus = route('narkotika.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'treadmill') {
                $routeCetak = route('treadmill.show', ['treadmill' => $dp->id]);
                $routeHapus = route('treadmill.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'gigi') {
                $routeCetak = route('gigi.show', ['gigi' => $dp->id]);
                $routeHapus = route('gigi.destroy', ['id' => $dp->id]);
                $routeHapus = route('treadmill.destroy', ['id' => $dp->id]);
              } elseif ($jenisPemeriksaan == 'tuberkulosis') {
                $routeCetak = route('tuberkulosis.show', ['tuberkulosis' => $dp->id]);
                $routeHapus = route('tuberkulosis.destroy', ['id' => $dp->id]);
              } else {
                $route = '';
              }
          @endphp
          <form action="{{ $routeHapus }}" method="POST">
            @csrf
            @method('DELETE')
          <x-blue-link-button href="{{ $routeCetak }}">Lihat Data</x-blue-link-button>
            <x-red-submit-button href="{{ $routeHapus }}" konfirmasi='Apakah Anda yakin ingin menghapus data ini?' >Hapus data</x-red-submit-button>
          </form>
      </td>
      </tr>
      @endforeach
    </x-table>
  </div>
  
  @endif
</div>
    
@endsection