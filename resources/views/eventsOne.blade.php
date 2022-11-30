<x-app-layout>    
    <div class="grid items-start lg:grid-cols-3 gap-4 lg:p-4">
        <div class="h-full lg:rounded-lg lg:border-2 border-gray-700 bg-gray-700 bg-opacity-20 col-span-3 lg:col-span-2 lg:row-span-3 p-4 cursor-pointer relative">
            @if (session()->has('alert'))
            <div class="absolute top-4 left-4 right-4">
            <x-alert :message="session('alert.message')" :level="session('alert.type')" class="rounded-b-none" />
            </div>
            @endif
            <div class="w-full h-[30vh] bg-cover bg-center rounded-lg mb-4" style="background-image: url('{{$event->cover}}');"></div>
            <div class="text-red-500 text-lg font-bold">{{$date}}</div>
            <div class="flex flex-wrap justify-between items-center">
                <span class="text-white text-xl font-bold">{{$event->title}}</span>  
                <div class="flex justify-end gap-2 py-2"> 
                    @if (Auth::user())
                        @if(Auth::user()->id != $event->id)       
                            <form action="" method="post" class="flex justify-end gap-2">
                                @csrf
                            
                            @if($allreadyJoined == null)
                                <x-secondary-button type="submit" name="choice" value="Interested"><i class="fal fa-fw fa-star"></i> Interested</x-secondary-button>
                                <x-secondary-button type="submit" name="choice" value="Going"><i class="fal fa-check-circle"></i> Going</x-secondary-button>
                            
                            @elseif($allreadyJoined)
                                @if($allreadyJoined->choice == 0)
                                    <x-primary-button><i class="fal fa-fw fa-star"></i> Interested</x-secondary-button>
                                    <x-secondary-button type="submit" name="change" value="Going"><i class="fal fa-check-circle"></i> Going</x-secondary-button>
                                @else
                                    <x-secondary-button type="submit" name="change" value="Interested"><i class="fal fa-fw fa-star"></i> Interested</x-secondary-button>
                                    <x-primary-button><i class="fal fa-check-circle"></i> Going</x-secondary-button>
                                @endif
                            @endif
                        @endif
                    @endif
                    </form>

                    <!-- Share Dropdown -->
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center justify-center gap-2 p-2 min-w-[50px] h-[38px] bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    <i class="fas fa-share"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-button>1</x-dropdown-button>
                                <x-dropdown-button>2</x-dropdown-button>
                                <x-dropdown-button>3</x-dropdown-button>
                                <x-dropdown-button>4</x-dropdown-button>
                            </x-slot>
                        </x-dropdown>
                    </div>   

                    
                    <!-- Share Dropdown -->
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center justify-center gap-2 p-2 min-w-[50px] h-[38px] bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if($allreadyJoined)
                                <form action="" method="post">
                                    @csrf
                                    <x-dropdown-button type="submit" name="leave" value="true" class="hover:bg-red-500"><i class="fas fa-fw fa-arrow-alt-circle-left"></i> Quit</x-dropdown-button>
                                </form>
                                <hr class="border-gray-400 border-1 my-1">
                                @endif
                                <x-dropdown-button><i class="fas fa-fw fa-bookmark"></i> Save</x-dropdown-button>
                                <x-dropdown-button class="hover:bg-red-500"><i class="fas fa-fw fa-exclamation"></i> Report Event</x-dropdown-button>
                                @if (Auth::user())
                                    @if(Auth::user()->id == $event->id)
                                    <hr class="border-gray-400 border-1 my-1">
                                    <x-dropdown-button type="submit" name="edit" value="true"><i class="fas fa-fw fa-pen"></i> Edit</x-dropdown-button>
                                    <x-dropdown-button id="deleteButton" data-modal-toggle="deleteModal" class="hover:bg-red-500"><i class="fas fa-fw fa-trash"></i> Delete</x-dropdown-button>
                                    @endif
                                @endif
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>                    
            </div>      
            <div class="text-gray-400 text-md">{{$event->fullAddress}}</div>
            <hr class="container mx-auto border-gray-700 border-1 my-2">
            <div class="flex flex-col text-white mb-2">
                <div class="inline-flex items-center gap-2 lg:hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-users"></i> {{$guests[2]}} people responded</div>
                <div class="inline-flex items-center gap-2 lg:hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-user"></i> Event by {{$event->username}}</div>
                <div class="inline-flex items-center gap-2 lg:hover:bg-gray-700 rounded-md py-2 px-2"><i class="text-gray-400 fas fa-fw fa-map-marker-alt"></i> {{$event->fullAddress}}</div>
                <div class="inline-flex items-center gap-2 lg:hover:bg-gray-700 rounded-md py-2 px-2">
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
       <div class="w-full h-full col-span-3 lg:col-span-1 lg:rounded-lg lg:border-2 border-gray-700 bg-gray-700 bg-opacity-25 p-4 flex justify-center items-center">
            <div class="grid grid-cols-6 gap-2 text-black text-6xl bg-yellow-200 rounded-lg p-2">
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
                <div class="p-2 bg-yellow-100 rounded-lg">0</div>
            </div>
        </div>
        <div class="w-full h-full col-span-3 lg:col-span-1 lg:rounded-lg lg:border-2 border-gray-700 bg-gray-700 bg-opacity-25 p-4 flex flex-col cursor-pointer">
            <div id="map" getdata="false" defaultView="" setLatLng="{{$event->latitude}},{{$event->longitude}}" class="w-full h-80 flex-grow rounded-t-md"></div>
            <div class="px-4 py-2 text-md font-medium text-white bg-gray-600 bg-opacity-25 rounded-b-lg hover:underline cursor-pointer">{{$event->fullAddress}}</div>
        </div>    
        <div class="w-full max-h-[400px] col-span-3 lg:col-span-1 lg:rounded-lg lg:border-2 border-gray-700 bg-gray-700 bg-opacity-25 px-4 py-2 cursor-pointer flex flex-col justify-start overflow-hidden">
            <div class="text-white text-xl font-bold">Guests</div>
            <div class="flex justify-between items-center text-white">
                <div class="w-full px-3 py-2 5 rounded-lg flex flex-col items-center hover:bg-gray-700">
                    <span>{{$guests[1]}}</span>
                    <span class="text-md font-bold">Going</span>
                </div>
                <div class="w-full px-3 py-2 5 rounded-lg flex flex-col items-center hover:bg-gray-700">
                    <span>{{$guests[0]}}</span>
                    <span class="text-md font-bold">Interested</span>
                </div>
            </div>
            @if (Auth::user())
                @if(Auth::user()->id == $event->id)
                <hr class="container mx-auto border-gray-700 border-1 my-2">
                <div class="flex-grow overflow-y-scroll">
                    <table class="table-auto w-full text-white text-left text-sm">
                        <thead class="bg-gray-600">
                            <tr>
                                <th class="text-center">Status</th>
                                <th>FullName</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allParticipant as $p)
                                <tr class="even:bg-gray-700 odd:bg-gray-800 hover:bg-gray-900 first:rounded-t-lg last:rounded-b-lg">
                                    <td class="text-center"><i class="fal fa-fw {{($p->choice == 0) ? 'fa-star' : 'fa-check-circle';}}"></i></td>
                                    <td>{{$p->lastname}} {{$p->firstname}}</td>
                                    <td>{{$p->username}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            @endif
        </div> 
        
        <div class="col-span-3 h-[10vh] lg:rounded-lg lg:border-2 border-gray-700 bg-gray-700 bg-opacity-25"></div>
    </div>











    <!-- Main modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full lg:inset-0 h-modal lg:h-full">
        <div class="relative p-4 w-full max-w-md h-full lg:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, I'm sure
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
