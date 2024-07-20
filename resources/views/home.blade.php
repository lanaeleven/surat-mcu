@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex justify-start mb-3">
  <div>
    <x-page-header>{{ $title }}</x-page-header>
  </div>
</div>
<div>

  <div class="flex justify-end mb-6">
    <div>
      <x-green-link-button href="/tambah-pasien">Tambah pasien</x-green-link-button>
    </div>
  </div>
  <div>
  <x-table :headers="['ID', 'Nama', 'No RM', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'Aksi']">
    @foreach ($pasiens as $pasien)
        <x-table-row :row="[$pasien->id, $pasien->nama, $pasien->noRM, $pasien->jenisKelamin, $pasien->tempatLahir, $pasien->tanggalLahir, $pasien->alamat, '']"
       />
    @endforeach 
    {{-- @foreach ($pasiens as $pasien)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
      <td class="px-6 py-4">
        {{ $pasien->id }}
      </td>
      <td class="px-6 py-4">
        {{ $pasien->nama }}
      </td>
      <td class="px-6 py-4">
        {{ $pasien->noRM }}
      </td>
      <td class="px-6 py-4">
        {{ $pasien->jenisKelamin }}
      </td>
      <td class="px-6 py-4">
        {{ $pasien->tempatLahir }}
      </td>
      <td class="px-6 py-4">
        {{ $pasien->tanggalLahir }}
      </td>  
      <td class="px-6 py-4">
        {{ $pasien->alamat }}
      </td>    
      <td class="px-6 py-4 text-right min-w-[200px]">
        <x-yellow-link-button href='/edit/{{ $pasien->id }}'>Edit</x-yellow-link-button>
        <x-blue-link-button href='/surat/{{ $pasien->id }}'>Buat Surat</x-blue-link-button>
    </td>
    </tr>
    @endforeach --}}
  </x-table>
</div>

<div class="flex justify-center my-5">
  <div>
    {{ $pasiens->appends(request()->input())->links() }}
  </div>
</div>
    
@endsection