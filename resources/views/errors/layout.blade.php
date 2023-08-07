<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('/favicons/favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicons/android-chrome-192x192.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f3f4f6;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

        </style>
    </head>
    <body class="grid min-h-screen grid-cols-1 font-sans antialiased bg-gray-100">
        <div class="sticky top-0 z-50">
            @include('layouts.navigation')
        </div>
        <div class="flex flex-col items-center justify-center px-5 full-height ">
            <div class="text-2xl font-semibold text-center md:text-6xl">
                @yield('code')
            </div>
            <div class="my-6">
                <x-application-logo2 class="w-20 h-20 text-gray-500 fill-current" />
            </div>
            <div class="text-lg md:text-2xl">
                @yield('message')
            </div>
            <div class="my-12 text-center">
                <x-primary-button onclick="location.href='{{ route('posts.index') }}'" class="bg-orange-500 shadow-md hover:bg-orange-400 hover:scale-95 active:scale-90 active:ring-offset-0 focus:ring-offset-0 active:bg-orange-500 focus:bg-orange-500 focus:ring-transparent">みんなの教案一覧へ</x-primary-button>
            </div>
        </div>
        <x-footer class="sticky bottom-0"/>
    </body>
</html>
