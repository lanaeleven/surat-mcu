<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <x-navbar>SURAT MCU</x-navbar>
@php
     $users = collect([
            (object)[
                'id' => 1,
                'nama' => 'Lorem ipsum dolor sit amet',
                'noRM' => 123456789,
                'jenisKelamin' => 'Laki-Laki',
                'tempatLahir' => 'New York',
                'tanggalLahir' => '01-01-2000',
                'alamat' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, ea. Laboriosam eaque laudantium debitis corporis fuga, aperiam soluta atque praesentium?'
            ],
        ]);
@endphp
  

<div class="container mx-auto mt-8">
  <x-table :headers="['ID', 'Nama', 'No RM', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'Aksi']">
    @for ($i = 0; $i < 20; $i++)
    @foreach ($users as $user)
        <x-table-row :row="[$user->id, $user->nama, $user->noRM, $user->jenisKelamin, $user->tempatLahir, $user->tanggalLahir, $user->alamat, 'Edit/Delete']"/>
    @endforeach        
    @endfor
</x-table>
</div>

</body>
</html>