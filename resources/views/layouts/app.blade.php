<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width, height=device-height, target-densitydpi=device-dpi">        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="description of your website/webpage, make sure you use keywords!" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/searchbox.css','resources/css/tagify.css', 'resources/js/app.js'])
        <style>html, body {overflow-x: hidden;}</style>

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
    <body class="font-sans antialiased relative">
        <div class="bg-gray-900 flex flex-col lg:flex-row justify-start items-center lg:items-start w-full h-screen relative overflow-y-scroll">
            @include('layouts.navigation')
            @include('layouts.navigation-mobile')            
            
            <!-- Page Content -->
            {{ $slot }}
            
            <!-- Footer -->
            <footer class="lg:hidden w-full mt-20 md:mt-4">
                <div class="bg-gray-900">
                    <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                        <p class="text-gray-400 text-sm text-center sm:text-left">© 2022 MapEvents —
                            <a href="https://www.instagram.com/makcnmas/" rel="noopener noreferrer" class="text-gray-500 ml-1" target="_blank">@makcnmas</a>
                        </p>
                        <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                            <a href="https://www.instagram.com/makcnmas/" target="_blank" class="ml-3 text-gray-400">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="tel:+41788305850" class="ml-3 text-gray-400">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a class="ml-3 text-gray-400" target="_blank" href="https://www.linkedin.com/in/maxime-sickenberg/">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
