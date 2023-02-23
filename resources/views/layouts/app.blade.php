<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}&nbsp;-&nbsp;だてまき</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

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
        <main class="container flex-1 px-3 mx-auto lg:px-12">
            {{ $slot }}
        </main>
        <x-footer class="sticky bottom-0"/>
    </body>
</html>
