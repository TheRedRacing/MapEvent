<x-app-layout>
    <div class="min-h-screen grid items-start grid-cols-3 gap-4 p-4">
        <div class="rounded-lg border-2 border-gray-700 bg-gray-700 bg-opacity-25 h-full col-span-2 row-span-3 p-4 cursor-pointer">
            <div class="w-full h-1/3 bg-cover bg-center rounded-lg mb-4" style="background-image: url('{{$event->cover}}');"></div>
            <div class="text-red-500 text-lg font-bold">{{$date}}</div>
            <div class="flex justify-between items-center">
                <span class="text-white text-xl font-bold ">{{$event->title}}</span>
                @if (Auth::user())
                    @if (Auth::user()->id == $event->user_id)
                    <div>
                        <div class="inline-flex items-center gap-2 bg-gray-700 border-0 py-1 px-3 focus:outline-none hover:bg-gray-600 rounded text-base text-white cursor-pointer">
                            <i class="fas fa-fw fa-pen"></i> Edit                               
                        </div>
                        <div class="inline-flex items-center gap-2 bg-red-600 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-base text-white cursor-pointer">
                            <i class="fas fa-fw fa-trash"></i> Delete                               
                        </div>
                        
                    </div>
                    @endif
                @endif
            </div>
            <div class="text-gray-400 text-md">{{$event->fullAddress}}</div>
            <hr class="container mx-auto border-gray-700 border-1 my-2">
            <div class="flex flex-col text-white mb-2">
                <div class="inline-flex items-center gap-2 hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-users"></i> 135 people responded</div>
                <div class="inline-flex items-center gap-2 hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-user"></i> {{$event->username}}'s event</div>
                <div class="inline-flex items-center gap-2 hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-map-marker-alt"></i> {{$event->fullAddress}}</div>
                <div class="inline-flex items-center gap-2 hover:bg-gray-700 rounded-md py-2 px-2">
                    @if($event->private == 0)
                        <i class="text-gray-400 fas fa-fw fa-globe"></i> Public  · Everyone can see it
                    @else
                        <i class="text-gray-400 fas fa-fw fa-lock"></i> Private  · Nobody can see it
                    @endif
                </div>
            </div>
            <hr class="container mx-auto border-gray-700 border-1 my-2">
            <div class="break-words text-white">
                {{$event->description}}
            </div>
        </div>
        <div class="row-span-3 flex flex-col gap-4">
            <div class="p-4 rounded-lg border-2 border-gray-700 bg-gray-700 bg-opacity-25 flex justify-center items-center">
                <div class="grid grid-cols-6 gap-2 text-black text-6xl bg-yellow-200 rounded-lg p-2">
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                    <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                </div>
            </div>
            <div class="rounded-lg border-2 border-gray-700 bg-gray-700 bg-opacity-25 flex flex-col cursor-pointer">
                <div id="map" getdata="false" setLatLng="{{$event->latitude}},{{$event->longitude}}" class="w-full h-80 flex-grow rounded-t-md"></div>
                <div class="px-4 py-2 text-md font-medium text-white bg-gray-700 bg-opacity-25 rounded-b-lg hover:underline cursor-pointer">{{$event->fullAddress}}</div>
            </div>    
            <div class="row-span-2 rounded-lg border-2 border-gray-700 bg-gray-700 bg-opacity-25 h-full cursor-pointer">
                
            </div>
        </div>           
    </div>
</x-app-layout>
