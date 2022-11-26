<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:title" content="How to Become an SEO Expert (8 Steps)" />
        <meta property="og:description" content="Get from SEO newbie to SEO pro in 8 simple steps." />
        <meta property="og:image" content="https://ahrefs.com/blog/wp-content/uploads/2019/12/fb-how-to-become-an-seo-expert.png" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/tagify.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="build/assets/searchbox.css">

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
