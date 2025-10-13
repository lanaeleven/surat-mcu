@extends('layouts.main')
@section('container')
@if (session()->has('success'))
<x-alert-dismiss>{{ session('success') }}</x-alert-dismiss>
@endif

<div class="flex bg-white p-5 items-center rounded-lg mb-5">
  <div class="flex-none w-24"></div>
  <div class="flex-auto"><x-page-header>{{ $title }}</x-page-header></div>
</div>

<div class="flex-row bg-white p-5 rounded-lg">
  <div class="flex justify-between align-middle">
  <a href="{{ route('dokter.index') }}">
    <div class="flex-none w-10 rounded-lg bg-green-200 hover:bg-green-100 p-1">
      <img src="{{ asset('images/doctor.png') }}" alt="">
    </div>
  </a>
    <div><x-green-link-button href="{{ route('pasien.create') }}">Tambah pasien</x-green-link-button></div>
  </div>
  
  @if ($pasien->isEmpty())
    <h3 class="text-center text-xl">Belum ada data pasien</h3>
  @else
      

  <div class="mt-5">
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
      <td class="px-6 py-4 min-w-[220px]">
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

@endif

</div>

    
@endsection