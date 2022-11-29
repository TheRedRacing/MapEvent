<x-app-layout>   
    <div id="spinner" class="show absolute inset-0 z-50 w-screen h-screen bg-gray-800 flex justify-center items-center opacity-100 transition-all ease-linear">
        <span class="text-white text-5xl animate-spin"><i class="fad fa-tire"></i></span>
    </div>    

    <div class="absolute top-1 left-1 right-1 md:top-5 md:left-5 md:right-5 z-20 flex flex-col md:flex-row justify-between items-center gap-5">
        <div class="flex justify-between items-center bg-gray-950 h-12 rounded-lg text-white relative">
            <div id="toggle-menu" class="p-5 cursor-pointer">
                <i class="fas fa-fw fa-arrow-alt-from-left"></i>
            </div>
            <div id="searchbox" class="flex justify-start items-center gap-5">
                <i class="far fa-fw fa-search px-5 cursor-pointer"></i>
            </div>
            <div  id="btnSettingMap" class="p-5 cursor-pointer">
                <i class="fas fa-fw fa-save"></i>
            </div> 
        </div>

        @if (session()->has('alert'))
            <x-alert :message="session('alert.message')" :level="session('alert.type')" />
        @endif

        <div id="mapzoom" class="flex justify-center items-center bg-gray-950 px-5 h-12 rounded-lg text-white">{{ $mapsettings->lat }}, {{ $mapsettings->lng }}, {{ $mapsettings->zoom }}x</div>
    </div>   

    <div id="map" getdata="true" defaultView="{{ $mapsettings->lat }}, {{ $mapsettings->lng }}, {{ $mapsettings->zoom }}x" class="w-full h-screen z-10"></div>
    <div class="absolute bottom-0 z-30 w-full bg-gray-950 rounded-t-3xl flex flex-col justify-start items-center">
        <span class="w-10 h-1 bg-gray-300 rounded-xl mt-2"></span>
        <div class="w-full flex items-center justify-start gap-4 pt-2 px-4 pb-4">
            <span class="w-16 h-16 rounded-full bg-cover" style="background-image: url('https://trello-backgrounds.s3.amazonaws.com/SharedBackground/2400x1600/2982fc7cc04a2e7a76172f52e7877197/photo-1561043845-2f5e09749871.jpg');"></span>
            <div class="flex flex-col text-white">
                <span class="text-red-500">4th December 2022 09:30 AM</span>
                <span class="">CCLS</span>
                <span class="text-gray-400">En Fléchère 7A, 1274 Signy-Avenex</span>
            </div>
        </div>
        <div class="w-full grid grid-cols-4 justify-start gap-4 px-4 pb-4">
            <a class="col-span-2 inline-flex items-center justify-center gap-2 p-2 min-w-[50px] h-[38px] bg-gray-700 border border-transparent rounded-full font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-fw fa-info-circle"></i> More details  
            </a>
            <button class="inline-flex items-center justify-center gap-2 p-2 h-[38px] bg-gray-700 border border-transparent rounded-full font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-share"></i>
            </button>
            <button class="inline-flex items-center justify-center gap-2 p-2 h-[38px] bg-gray-700 border border-transparent rounded-full font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-ellipsis-h"></i>
            </button>   
        </div>
    </div>
    
    
    <div class="absolute z-20 bg-gray-800 p-2 rounded-md none flex-col gap-1" id="rightmenu">
        <div class="px-5 py-2.5 text-white rounded-md hover:bg-indigo-600 cursor-pointer">
            <i class="fas fa-fw fa-lock-open"></i>
            <span class="pl-2">Enter Event Code</span>
        </div>
        <hr class="border-gray-600 border-1">
        <div class="px-5 py-2.5 text-white rounded-md hover:bg-indigo-600 cursor-pointer">
            <i class="far fa-fw fa-cog"></i>
            <span class="pl-2">Settings</span>
        </div>        
    </div>                 
</x-app-layout>
