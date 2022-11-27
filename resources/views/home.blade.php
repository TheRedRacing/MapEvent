<x-app-layout>   
    <div id="spinner" class="show absolute inset-0 z-50 w-screen h-screen bg-gray-800 flex justify-center items-center opacity-100 transition-all ease-linear">
        <span class="text-white text-5xl animate-spin"><i class="fad fa-tire"></i></span>
    </div>    

    <div class="absolute top-5 left-5 right-5 z-20 flex justify-between items-center gap-5">
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
    <div class="absolute bottom-5 right-5 flex flex-row justify-end items-start z-20 w-2/5" style="height: 85vh; display:none;" id="eventinfo"><div id="parent-btn-tabs" class="flex flex-col h-full"></div><div id="parent-tabs" class="flex-grow min-h-fit"></div><a class="event-card-close absolute top-5 right-5 text-xl text-red-500 cursor-pointer"><i class="fas fa-times"></i></a></div>
    
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
