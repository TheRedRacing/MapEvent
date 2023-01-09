<x-guest-layout>
    <div class="grid h-screen w-screen grid-rows-3 grid-cols-3 gap-2 p-2 bg-gray-600">
        <div class="relative bg-gray-700 border-gray-800 rounded-xl">
            <div id="map" defaultView="[0, 0, 0]" centerMarker="false" desableScroll="false" getData="true" class="initmap w-full h-full relative  rounded-xl"></div>
            <div class="absolute top-0 left-0 right-0 rounded-t-xl text-white bg-black bg-opacity-50 text-center">Default Map</div>
        </div>  
        
        <div class="relative bg-gray-700 border-gray-800 rounded-xl">
            <div id="map1" defaultView="[46.397241, 6.206443, 10]" centerMarker="false" desableScroll="false" getData="false" class="initmap w-full h-full relative  rounded-xl"></div>
            <div class="absolute top-0 left-0 right-0 rounded-t-xl text-white bg-black bg-opacity-50 text-center">Default Map with defaultview</div>
        </div> 
        
        <div class="relative bg-gray-700 border-gray-800 rounded-xl">
            <div id="map2" defaultView="[46.397241, 6.206443, 16]" centerMarker="true" desableScroll="false" getData="false" class="initmap w-full h-full relative  rounded-xl"></div>
            <div class="absolute top-0 left-0 right-0 rounded-t-xl text-white bg-black bg-opacity-50 text-center">Default Map with defaultview and marker</div>
        </div> 
        
        <div class="relative bg-gray-700 border-gray-800 rounded-xl">
            <div id="map3" defaultView="[46.397241, 6.206443, 16]" centerMarker="true" desableScroll="true" getData="false" class="initmap w-full h-full relative  rounded-xl"></div>
            <div class="absolute top-0 left-0 right-0 rounded-t-xl text-white bg-black bg-opacity-50 text-center">Default Map with defaultview and centerMarker and desableScroll</div>
        </div> 

        <div class="relative bg-gray-700 border-gray-800 rounded-xl">
            <div id="map4" defaultView="[46.397241, 6.206443, 5]" centerMarker="false" desableScroll="false" getData="true" class="initmap w-full h-full relative  rounded-xl"></div>
            <div class="absolute top-0 left-0 right-0 rounded-t-xl text-white bg-black bg-opacity-50 text-center">Default Map with defaultview and data</div>
        </div> 
    </div>
</x-guest-layout>