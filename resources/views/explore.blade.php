<x-app-layout>
    <div class="px-5">
        <div class="py-5 text-2xl text-white">{{__('Explore')}}</div>
        <div class="mx-auto flex flex-col justify-center items-start gap-5">
            <div class="w-full h-[30vh] rounded-md bg-green-600"></div>
            <div class="w-full flex-grow grid grid-cols-4 gap-5">                
                @forelse ($events as $event)
                <a href="events/{{$event->uuid}}" class="h-full flex flex-col bg-gray-800 border-2 border-gray-800 rounded-md hover:border-green-700 cursor-pointer hover:-translate-y-1 transition-transform duration-200">
                    <!-- Fake Image -->
                    <div class="w-full h-32 bg-cover bg-center rounded-t-md" style="background-image:url('{{$event->cover}}')"></div>
                    <!-- Body Card -->
                    <div class="flex-grow flex flex-col justify-between gap-2.5 py-3 px-4">
                        <div class="mb-2">
                            <div class=" mb-1 flex justify-between items-center">
                                <h1 class="text-lg font-medium text-white">{{$event->title}}</h1>
                                @if($event->private == 0)
                                    <i class="far fa-globe text-gray-400"></i>
                                @else
                                    <i class="far fa-lock text-gray-400"></i>
                                @endif
                            </div>
                            <p class="line-clamp-3 break-words text-sm text-gray-400">{{$event->description}}</p>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400">
                            <span class="inline-flex items-center gap-1 leading-none text-xs pr-3 border-r-2 border-gray-800">
                                <i class="fas fa-fw fa-check-square text-green-500"></i> 2000 Participant
                            </span>
                            <span class="inline-flex items-center gap-1 leading-none text-xs">
                                <i class="fas fa-fw fa-star"></i> 1679 Intéressé(e)s
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                    <div class="w-full col-span-4 row-span-full flex justify-center items-center  ">
                        <div class="w-1/3 p-12 border border-dashed border-gray-200 flex flex-col justify-center items-center gap-2.5 rounded-lg">
                            <i class="far fa-fw fa-calendar text-gray-400 text-4xl"></i>
                            <div class="mb-2 text-lg font-medium text-gray-400">No Events</div>
                            <x-primary-button>
                                <i class="fal fa-fw fa-plus"></i> New Events
                            </x-primary-button>
                        </div>
                    </div>
                @endforelse  
            </div>
        </div>
    </div>
</x-app-layout>