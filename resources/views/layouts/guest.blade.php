<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Menambahkan style untuk background --}}
        <style>
            .bg-auth-image {
                background-image: url('{{ asset('images/sakola.jpg') }}');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Kontainer utama dengan gambar background dan overlay gelap agar form lebih terbaca --}}
        <div class="bg-auth-image min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
            
            {{-- Lapisan overlay gelap (opsional, tapi disarankan) --}}
            <div class="absolute inset-0 bg-black opacity-40"></div>
            
            {{-- Konten (form login Anda) akan ditampilkan di sini --}}
            <div class="relative z-10 w-full sm:max-w-md">
                {{-- $slot ini adalah tempat kode dari login.blade.php dimasukkan --}}
                {{ $slot }}
            </div>
        </div>
    </body>
</html>