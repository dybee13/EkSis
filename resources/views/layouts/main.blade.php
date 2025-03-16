@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eksis || {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body>
    @if (Request::is('admin/*'))
        @include('partials.sidebar')
    @else
        @include('partials.navbar')
    @endif
    <div class="container font-serif">
        @yield('container')
    </div>
</body>

</html>
