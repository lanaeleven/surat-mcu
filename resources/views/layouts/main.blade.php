<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')
</head>
<body>
  <x-navbar>SURAT MCU</x-navbar>
<div class="container mx-auto mt-8">

  @yield('container')

</div>
</body>
</html>