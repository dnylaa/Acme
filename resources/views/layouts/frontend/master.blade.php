<!DOCTYPE html>
<html lang="id">
<head>
  @include('layouts.frontend.head')
  @include('layouts.frontend.style')

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  @include('layouts.frontend.navbar')

  {{-- Konten utama --}}
  @yield('content')

  @include('layouts.frontend.footer')
  @include('layouts.frontend.script')
  @stack('scripts')
</body>
</html>
