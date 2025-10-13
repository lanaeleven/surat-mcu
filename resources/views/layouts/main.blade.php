<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')

  {{-- TRIX EDITOR --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
  <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display:none;
    }
  </style>

</head>
<body class="bg-[#e0e4ee]">
  <x-navbar>SURAT MCU</x-navbar>
<div class="container mx-auto mt-4">

  @yield('container')

</div>
<script>
  function disableTrix() {
    document.querySelector('trix-editor').editor.element.setAttribute('contentEditable', false)
}
  
</script>
</body>
</html>