@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div>
<div class="grid grid-cols-3 align-middle mb-6">
  <div></div>
  <div class="text-center">
    <x-page-header>{{ $title }}</x-page-header>
  </div>
  <div class="text-end">
    <x-green-link-button href="{{ route('pasien.create') }}">Tambah pasien</x-green-link-button>
  </div>
</div>
  <div>
  <x-table :headers="['ID', 'Nama', 'No RM', 'Jenis Kelamin', 'TTL', 'Alamat', 'Aksi']">
    {{-- @foreach ($pasien as $p)
        <x-table-row :row="[$p->id, $p->nama, $p->noRM, $p->jenisKelamin, $p->tempatLahir, $p->tanggalLahir, $p->alamat, '']"
       />
    @endforeach  --}}
    @foreach ($pasien as $p)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-600"> 
      <td class="px-6 py-4">
        {{ $p->id }}
      </td>
      <td class="px-6 py-4">
        {{ $p->nama }}
      </td>
      <td class="px-6 py-4">
        {{ $p->noRM }}
      </td>
      <td class="px-6 py-4">
        {{ $p->jenisKelamin }}
      </td>
      <td class="px-6 py-4">
        {{ $p->tempatLahir }}, {{ $p->tanggalLahir }}
      </td>
      <td class="px-6 py-4">
        {{ $p->alamat }}
      </td>
      <td class="px-6 py-4 min-w-[200px]">
        <x-yellow-link-button href="{{ route('pasien.edit', ['pasien' => $p->id]) }}">Edit</x-yellow-link-button>
        <x-blue-link-button href="{{ route('surat.index', ['pasien' => $p->id]) }}">Buat Surat</x-blue-link-button>
      </td>        
    </tr>
    @endforeach
  </x-table>
</div>

<div class="flex justify-center my-5">
  <div>
    {{ $pasien->appends(request()->input())->links() }}
  </div>
</div>
    
@endsection