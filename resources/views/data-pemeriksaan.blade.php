@extends('layouts.main')
@section('container')
{{-- @dd($audiometri) --}}
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex justify-between mb-6">
  <div>
    <x-page-header>{{ $title }}</x-page-header>
  </div>
  <div></div>
  <div>
    <x-green-link-button href="/tambah-data/">Tambah Data</x-green-link-button>
  </div>
</div>
<div>
  @if ($audiometri->isEmpty())
      <h3 class="text-center text-xl">Tidak terdapat data pemeriksaan</h3>
  @else
  
  <x-table :headers="['Pasien', 'Dokter Pemeriksa', 'Tanggal Terakhir diedit', 'Aksi']">
    @foreach ($audiometri as $a)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-gray-600">
      <td class="px-6 py-4">
        {{ $a->pasien->nama }} ({{ $a->pasien->noRM }})
      </td>
      <td class="px-6 py-4">
        {{ $a->dokter->nama }}
      </td>   
      <td class="px-6 py-4">
        {{ $a->updated_at }}
      </td>      
      <td class="px-6 py-4 text-right min-w-[200px]">
        <x-blue-link-button href='/cetak/{{ $a->id }}'>Cetak Data</x-blue-link-button>
        <x-yellow-link-button href='/hapus/{{ $a->id }}'>Hapus Data</x-yellow-link-button>
    </td>
    </tr>
    @endforeach
  </x-table>
  @endif
</div>
    
@endsection