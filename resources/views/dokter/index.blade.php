@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif
{{-- @dd($dokter) --}}

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
  <div class="flex-none w-24"><x-yellow-link-button href="{{ route('pasien.index') }}">Kembali</x-yellow-link-button></div>
  <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg">
  <div class="flex justify-end">
    <div><x-green-link-button href="{{ route('dokter.create') }}">Tambah dokter</x-green-link-button></div>
  </div>

@if ($dokter->isEmpty())
  <h3 class="text-center text-xl">Belum ada data dokter</h3>
@else
  
  <div class="mt-5">
  <x-table :headers="['ID', 'Nama', 'SIP', 'Aksi']">
    @foreach ($dokter as $d)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-600"> 
      <td class="px-6 py-4">
        {{ $d->id }}
      </td>
      <td class="px-6 py-4">
        {{ $d->nama }}
      </td>
      <td class="px-6 py-4">
        {{ $d->sip }}
      </td>
      <td class="px-6 py-4 min-w-[100px]">
        <x-yellow-link-button href="{{ route('dokter.edit', ['dokter' => $d->id]) }}">Edit</x-yellow-link-button>
      </td>        
    </tr>
    @endforeach
  </x-table>
</div>

@endif

</div>

    
@endsection