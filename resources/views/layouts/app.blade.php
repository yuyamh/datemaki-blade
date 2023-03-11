<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}&nbsp;-&nbsp;だてまき</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('/favicons/favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicons/android-chrome-192x192.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col min-h-screen font-sans antialiased bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow md:z-40 md:top-0 md:sticky">
                <div class="px-4 py-6 mx-auto text-xl font-semibold leading-tight text-gray-800 max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @if (session('successMessage'))
            <div class="text-center bg-green-300">
                <p class="text-lg text-green-700">{{ session('successMessage') }}</p>
            </div>
        @endif
        <main class="w-full px-4 mx-auto">
            <div class="block w-full lg:grid-cols-12 lg:grid py-14">
                <div class="lg:col-span-9">
                    {{ $slot }}
                </div>
                <div class="block px-8 lg:col-span-3 lg:px-6">
                    <x-search-form />
                </div>
            </div>
        </main>
        <x-footer class="sticky bottom-0"/>
    </body>
</html>
