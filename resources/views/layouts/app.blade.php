<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="description of your website/webpage, make sure you use keywords!" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/searchbox.css','resources/css/tagify.css', 'resources/js/app.js'])

        <!-- External link -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps.css'>
        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js'></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/services/services-web.min.js'></script>

        <!-- Tagify -->
        <script src="https://unpkg.com/@yaireo/tagify@4.17.1/dist/tagify.min.js"></script>
        <!-- Searchbox -->
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.2.0/SearchBox-web.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-900 flex justify-start items-center w-full h-screen overflow-hidden">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="w-full h-screen relative">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
