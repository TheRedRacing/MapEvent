<x-app-layout>
    <div class="pt-6 px-4">
        <div class="flex justify-between items-center gap-5">
            <div class="text-2xl text-white">Admin Page</div>
            
            @if (session()->has('alert'))
                <x-alert :message="session('alert.message')" :level="session('alert.type')" />
            @endif

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base text-white mt-4 md:mt-0">
                <i class="fas fa-arrow-alt-left"></i> Back                              
            </a>
        </div>
        <div class="w-full flex flex-wrap justify-between gap-5 text-center py-4">
            <div class="text-white flex justify-start items-center gap-5 p-5 bg-gray-800 rounded-md flex-grow">
                <div class="bg-green-700 p-4 flex justify-center items-center rounded-md text-xl">
                    <i class="fas fa-fw fa-user"></i>
                </div>
                <div class="flex flex-col justify-start items-start">
                    <span class="text-gray-400 text-lg">Total users</span>
                    <span class="">{{$nbuser}}</span>
                </div>
            </div>

            <div class="text-white flex justify-start items-center gap-5 p-5 bg-gray-800 rounded-md flex-grow">
                <div class="bg-green-700 p-4 flex justify-center items-center rounded-md text-xl">
                    <i class="fas fa-fw fa-calendar-star"></i>
                </div>
                <div class="flex flex-col justify-start items-start">
                    <span class="text-gray-400 text-lg">Total Events</span>
                    <span class="">{{$nbevent}}</span>
                </div>
            </div>

            <div class="text-white flex justify-start items-center gap-5 p-5 bg-gray-800 rounded-md flex-grow">
                <div class="bg-green-700 p-4 flex justify-center items-center rounded-md text-xl">
                    <i class="fas fa-fw fa-user"></i>
                </div>
                <div class="flex flex-col justify-start items-start">
                    <span class="text-gray-400 text-lg">Total </span>
                    <span class="">x</span>
                </div>
            </div>
        </div>
        <hr>
    </div>
</x-app-layout>