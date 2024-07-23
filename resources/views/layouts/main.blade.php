<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-[#e0e4ee]">
  <x-navbar>SURAT MCU</x-navbar>
<div class="container mx-auto mt-4">

  @yield('container')

</div>
</body>
</html>