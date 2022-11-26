<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])

        <!-- External css -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    </head>
    
    <body class="antialiased bg-gray-900">
        <header class="text-gray-400 bg-gray-900 body-font">
            <div class="mx-auto w-full flex flex-wrap py-5 px-10 flex-col md:flex-row items-center">
                <a class="flex justify-center title-font font-medium items-center text-white mb-4 md:mb-0 cursor-pointer">
                    <span class="flex justify-center items-center w-10 h-10 text-white p-2 bg-green-700 rounded-full"><i class="fas fa-fw fa-map"></i></span>
                    <span class="ml-3 text-xl">MapEvents</span>
                </a>
                
                <nav class="md:ml-auto md:mr-auto flex gap-5 flex-wrap items-center text-base justify-center cursor-pointer">
                    <a class="hover:text-white">{{__('welcome.Home')}}</a>
                    <a class="hover:text-white">{{__('welcome.Feature')}}</a>
                    <a class="hover:text-white">{{__('welcome.Support')}}</a>
                    <a class="hover:text-white">{{__('welcome.Blog / News')}}</a>
                    <a class="hover:text-white">{{__('welcome.Careers')}}</a>
                </nav>
                
                <div class="flex items-center justify-center gap-3 text-white cursor-pointer">   
                    <div class="relative">
                        <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="inline-flex items-center gap-2 bg-gray-800 text-gray-400 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0" type="button">
                            {{__('welcome.Language')}}
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown" class="absolute right-0 top-10 z-10 w-32 p-1 divide-y divide-gray-100 bg-gray-800 shadow rounded-md" style="display: none;">
                            <form action="" method="POST">
                                @csrf
                                <div class="flex flex-col gap-1">
                                    <button type="submit" value="en" name="changeLanguage" class="flex items-center gap-2.5 px-3 py-2 rounded-md hover:bg-gray-700">
                                        <img src="https://flagcdn.com/gb.svg" class="w-6 h-6 rounded-full object-cover"/>
                                        {{__('welcome.English')}}
                                    </button>
                                    <button type="submit" value="fr" name="changeLanguage" class="flex items-center gap-2.5 px-3 py-2 rounded-md hover:bg-gray-700">
                                        <img src="https://flagcdn.com/fr.svg" class="w-6 h-6 rounded-full object-cover"/>
                                        {{__('welcome.French')}}
                                    </button>
                                    <button type="submit" value="de" name="changeLanguage" class="flex items-center gap-2.5 px-3 py-2 rounded-md hover:bg-gray-700">
                                        <img src="https://flagcdn.com/de.svg" class="w-6 h-6 rounded-full object-cover"/>
                                        {{__('welcome.German')}}
                                    </button>
                                    <button type="submit" value="it" name="changeLanguage" class="flex items-center gap-2.5 px-3 py-2 rounded-md hover:bg-gray-700">
                                        <img src="https://flagcdn.com/it.svg" class="w-6 h-6 rounded-full object-cover"/>
                                        {{__('welcome.Italian')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (Route::has('login'))                    
                        @auth
                            <a href="{{ url('/home') }}" class="inline-flex items-center gap-2 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">
                                {{__('welcome.Go to app')}}                                
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-gray-400 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 hover:text-white rounded text-base mt-4 md:mt-0">
                                {{__('welcome.Log in')}}
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-green-700 border-0 py-1 px-3 focus:outline-none hover:bg-green-800 rounded text-base mt-4 md:mt-0">
                                    {{__('welcome.Register')}}                                
                                </a>
                            @endif
                        @endauth
                    @endif  
                </div>
            </div>
        </header>
        <section class="text-gray-400 bg-gray-900 body-font h-[calc(100vh-80px)] flex justify-center items-center">
            <div class="flex items-center justify-center flex-col">
                <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                <div class="text-center lg:w-2/3 w-full">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Microdosing synth tattooed vexillologist</h1>
                    <p class="leading-relaxed mb-8">Meggings kinfolk echo park stumptown DIY, kale chips beard jianbing tousled. Chambray dreamcatcher trust fund, kitsch vice godard disrupt ramps hexagon mustache umami snackwave tilde chillwave ugh. Pour-over meditation PBR&amp;B pickled ennui celiac mlkshk freegan photo booth af fingerstache pitchfork.</p>
                    <div class="flex justify-center">
                        <button class="inline-flex text-white bg-green-700 border-0 py-2 px-6 focus:outline-none hover:bg-green-800 rounded text-lg">Button</button>
                        <button class="ml-4 inline-flex text-gray-400 bg-gray-800 border-0 py-2 px-6 focus:outline-none hover:bg-gray-700 hover:text-white rounded text-lg">Button</button>
                    </div>
                    <i class="fas pt-10 fa-chevron-down text-white cursor-pointer"></i>
                </div>
            </div>
        </section>

        <hr class="container mx-auto border-gray-600 border-1">
        
        <section class="text-gray-400 body-font">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                    <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                </div>
                <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Before they sold out
                        <br class="hidden lg:inline-block">readymade gluten
                    </h1>
                    <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
                </div>
            </div>
        </section>

        <hr class="container mx-auto border-gray-600 border-1">

        <section class="text-gray-400 body-font">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Before they sold out
                        <br class="hidden lg:inline-block">readymade gluten
                    </h1>
                    <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
                </div>
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                    <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                </div>
            </div>
        </section>   
        
        <hr class="container mx-auto border-gray-600 border-1">

        <section class="text-gray-400 body-font">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                    <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                </div>
                <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Before they sold out
                        <br class="hidden lg:inline-block">readymade gluten
                    </h1>
                    <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
                </div>
            </div>
        </section>

        <hr class="container mx-auto border-gray-600 border-1">

        <section class="text-gray-400 body-font">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Before they sold out
                        <br class="hidden lg:inline-block">readymade gluten
                    </h1>
                    <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
                </div>
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                    <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                </div>
            </div>
        </section>   

        <hr class="container mx-auto border-gray-600 border-1">

        <footer class="text-gray-600 body-font cursor-pointer">
            <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
                <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                    <a class="flex justify-start title-font font-medium items-center text-white mb-4 md:mb-0">
                        <span class="flex justify-center items-center w-10 h-10 text-white p-2 bg-green-700 rounded-full"><i class="fas fa-map"></i></span>
                        <span class="ml-3 text-xl">MapEvents</span>
                    </a>
                    <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p>
                </div>
                <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                            <li>
                                <a class="text-gray-400 hover:text-white">First Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Second Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Third Link</a>
                            </li>
                            <li>
                                <a class="text-gray-400 hover:text-white">Fourth Link</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="bg-gray-700 bg-opacity-75">
                <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                    <p class="text-gray-500 text-sm text-center sm:text-left">© 2022 CarDistrict —
                        <a href="https://twitter.com/" rel="noopener noreferrer" class="text-gray-600 ml-1" target="_blank">@makcnmas</a>
                    </p>
                    <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                        <a class="ml-3 text-gray-400">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="ml-3 text-gray-400">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="ml-3 text-gray-400">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a class="ml-3 text-gray-400" target="_blank" href="https://www.linkedin.com/in/maxime-sickenberg/">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </span>
                </div>
            </div>
        </footer>
    </body>
</html>
