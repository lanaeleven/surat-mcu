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
    <x-table :headers="['Pasien', 'Dokter Pemeriksa', 'Tanggal Terakhir diedit', 'Aksi']">
      @foreach ($dataPemeriksaan as $dp)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-600">
        <td class="px-6 py-4">
          {{ $dp->pasien->nama }} ({{ $dp->pasien->noRM }})
        </td>
        <td class="px-6 py-4">
          {{ $dp->dokter->nama }}
        </td>   
        <td class="px-6 py-4">
          {{ $dp->updated_at }}
        </td>      
        <td class="px-6 py-4 min-w-[200px]">
          @php
              if ($jenisPemeriksaan == 'audiometri') {
                $route = route('audiometri.show', ['audiometri' => $dp->id]);
              } else {
                $route = '';
              }
          @endphp
          <x-blue-link-button href="{{ $route }}">Cetak Data</x-blue-link-button>
          {{-- <x-yellow-link-button href='/hapus/{{ $dp->id }}'>Hapus Data</x-yellow-link-button> --}}
      </td>
      </tr>
      @endforeach
    </x-table>
  </div>
  
  @endif
</div>
    
@endsection