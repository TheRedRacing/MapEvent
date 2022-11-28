<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MapEvents') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">

        @vite(['resources/css/app.css'])

        <!-- External css -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js'></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/services/services-web.min.js'></script>
        <!-- Searchbox -->
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.2.0/SearchBox-web.js"></script>
    </head>
    
    <body class="antialiased bg-gray-900 overflow-hidden">
        <header class="text-gray-400 bg-gray-900 body-font">
            <div class="mx-auto w-full flex flex-wrap justify-between py-5 px-10 flex-col md:flex-row items-center">
                <a class="flex justify-center title-font font-medium items-center text-white mb-4 md:mb-0 cursor-pointer">
                    <span class="flex justify-center items-center w-10 h-10 text-white p-2 bg-green-700 rounded-full"><i class="fas fa-fw fa-map"></i></span>
                    <span class="ml-3 text-xl">MapEvents</span>
                </a>               
                
                
                <div class="flex items-center justify-center gap-3 text-white cursor-pointer">   
                    @if (Route::has('login'))                    
                        @auth
                            <a href="{{ url('/home') }}" class="inline-flex items-center gap-2 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">
                                {{__('welcome.Go to app')}}                                
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-gray-400 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 hover:text-white rounded text-base mt-4 md:mt-0">
                                {{__('welcome.Log in')}}
                            </a>
                        @endauth
                    @endif  
                </div>
            </div>
        </header>      
        
        <img src="{{ URL::to('/') }}/img/map-bg.png" class="absolute top-20 left-0 right-0 bottom-14 -z-20" alt="">
        
        <div class="absolute inset-0 -z-10 flex items-center justify-center">        
            <div class="bg-green-700 rounded-lg p-10 text-white" x-data="beer()" x-init="start()">
                <h1 class="font-bold text-4xl md:text-5xl mb-10">MapEvents Will Open</h1>
                <div class="text-6xl text-center flex w-full items-center justify-center">
                    <div class="text-2xl mr-1 font-medium">in</div>
                    <div class="w-24 mx-1 p-2 bg-white text-green-500 rounded-lg">
                        <div class="font-mono leading-none" x-text="days">00</div>
                        <div class="font-mono uppercase text-sm font-medium leading-none">Days</div>
                    </div>
                    <div class="w-24 mx-1 p-2 bg-white text-green-500 rounded-lg">
                        <div class="font-mono leading-none" x-text="hours">00</div>
                        <div class="font-mono uppercase text-sm font-medium leading-none">Hours</div>
                    </div>
                    <div class="w-24 mx-1 p-2 bg-white text-green-500 rounded-lg">
                        <div class="font-mono leading-none" x-text="minutes">00</div>
                        <div class="font-mono uppercase text-sm font-medium leading-none">Minutes</div>
                    </div>
                    <div class="text-2xl mx-1 font-medium">and</div>
                    <div class="w-24 mx-1 p-2 bg-white text-green-500 rounded-lg">
                        <div class="font-mono leading-none" x-text="seconds">00</div>
                        <div class="font-mono uppercase text-sm font-medium leading-none">Seconds</div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="absolute bottom-0 left-0 right-0">
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

        <div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed bottom-0 left-0">
            <div class="relative p-4 w-full max-w-lg h-auto">
                <div class="relative rounded-lg shadow bg-gray-800 p-8">
                    <div class="mb-4 text-sm font-light text-gray-400">
                        <h3 class="mb-3 text-2xl font-bold text-white">Privacy info</h3>
                        <p>
                            The backup created with this export functionnality may contain some sensitive data. We suggest you to save this archive in a securised location.
                        </p>
                    </div>
                    <div class="justify-between items-center space-y-2">
                        <a href="#" class="font-medium text-green-600 hover:underline">Learn more about privacy</a>
                        <div class="items-center space-x-2">
                            <button id="close-modal" type="button"  class="py-2 px-4 w-full text-sm font-medium rounded-lg border sm:w-auto focus:ring-4 focus:outline-none text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                            <button id="confirm-button" type="button" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-green-700 sm:w-auto hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    function beer() {
        return {
            seconds: '00',
            minutes: '00',
            hours: '00',
            days: '00',
            distance: 0,
            countdown: null,
            beerTime: new Date('April 30, 2023 16:30:00').getTime(),
            now: new Date().getTime(),
            start: function() {
                this.countdown = setInterval(() => {
                    // Calculate time
                    this.now = new Date().getTime();
                    this.distance = this.beerTime - this.now;
                    // Set Times
                    this.days = this.padNum( Math.floor(this.distance / (1000*60*60*24)) );
                    this.hours = this.padNum( Math.floor((this.distance % (1000*60*60*24)) / (1000*60*60)) );
                    this.minutes = this.padNum( Math.floor((this.distance % (1000*60*60)) / (1000*60)) );
                    this.seconds = this.padNum( Math.floor((this.distance % (1000*60)) / 1000) );
                    // Stop
                    if (this.distance < 0) {
                        clearInterval(this.countdown);
                        this.days = '00';
                        this.hours = '00';
                        this.minutes = '00';
                        this.seconds = '00';
                    }
                },100);
            },
            padNum: function(num) {
                var zero = '';
                for (var i = 0; i < 2; i++) {
                    zero += '0';
                }
                return (zero + num).slice(-2);
            }
        }
    }
</script>