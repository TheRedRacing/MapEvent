<x-app-layout>    
    <div id="stepForm" StepForm="4" class="p-5 w-full h-screen flex flex-col justify-start gap-5 text-white">
        <div class="text-2xl text-white">Create new event</div>
        <div class="w-full flex justify-between gap-5">        
            <x-step-btn id="step1">Maps</x-step-btn>
            <x-step-btn id="step2">Information</x-step-btn>
            <x-step-btn id="step3">Form</x-step-btn>
            <x-step-btn id="step4">Validation</x-step-btn>
        </div>

        <div class="flex-grow flex flex-col gap-5" id="form-step-1">
            <div class="w-full flex justify-between items-center">
                <div class="flex justify-start items-center gap-5">
                    <x-text-input id="latitude" type="text" name="latitude" :value="old('latitude')" required placeholder="latitude"/>
                    <x-text-input id="longitude" type="text" name="longitude" :value="old('longitude')" required placeholder="Longitude"/>

                    <div class="flex justify-between items-center bg-gray-950 h-12 rounded-lg text-white px-2 relative">
                        <div id="searchbox" class="flex justify-start items-center gap-5">
                            <i class="far fa-fw fa-search p-5 cursor-pointer"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="btnToGetCenter" class="text-white flex justify-center items-center gap-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 cursor-pointer">
                        Set Location
                    </div>
                </div>
            </div>
            <div class="relative grid grid-cols-1 grid-rows-1 flex-grow">
                <div class="absolute top-5 left-5 right-5 z-20 flex justify-between items-center gap-5">
                    <div id="mapzoom" class="flex justify-center items-center bg-gray-950 px-5 h-12 rounded-lg text-white">{{ $mapsettings->lat }}, {{ $mapsettings->lng }}, {{ $mapsettings->zoom }}x</div>
                </div>

                <div id="map" getdata="false" class="w-full row-span-1 rounded-lg"></div>

                <i class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 fal fa-crosshairs text-xl text-black z-30"></i>
            </div> 
        </div>

        <div class="flex-grow flex flex-col justify-start items-center  gap-5" id="form-step-2" style="display:none;">
            <div class="w-2/3 bg-gray-800 p-5 rounded-lg flex flex-col gap-5">
                <div class="w-full">
                    <x-input-label for="title" :value="__('Title *')" />
                    <x-text-input id="title" placeholder="Title of event" class="block w-full" type="text" name="title" :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-input-label for="date" :value="__('Date and Time *')" />
                    <div class="flex justify-end items-center gap-5">
                        <div class="flex-grow">
                            <x-text-input style="color-scheme: dark;" id="date" class="w-full" type="date" name="date" :value="old('date')" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                        <span class="text-gray-400">at</span>
                        <div class="flex-grow">
                            <x-text-input style="color-scheme: dark;" id="time" class="w-full" type="time" name="time" :value="old('time')" required />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="2" onfocus="this.rows='5'" onblur="this.rows='2'" class="block w-full bg-gray-600 bg-opacity-20 focus:bg-transparent h-20 focus:h-40 focus:ring-2 focus:ring-indigo-900 rounded border border-gray-600 focus:border-indigo-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-all duration-200 ease-in-out" placeholder="Your description here"></textarea>
                </div>

                <div>
                    <x-input-label for="tags" :value="__('Tags (max 5)')" />
                    <input id="tags" type="text" class="block w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-indigo-900 rounded border border-gray-600 focus:border-indigo-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-all duration-200 ease-in-out" name="tags" value="" />
                </div>

                <div>
                    <x-input-label for="cover" :value="__('Cover *')" />
                    <input id="cover" type="file" class="block w-full rounded-lg border cursor-pointer text-gray-500 focus:ring-2 focus:ring-indigo-900 bg-gray-600 bg-opacity-20 border-gray-600" name="cover"/>
                </div>

                <hr class="border-gray-600 border-1">
                <div class="flex flex-col gap-2.5">
                    <div class="flex items-center">
                        <input id="checkbox-1" name="private" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                        <label for="checkbox-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Private ?</label>
                    </div>
                     <!-- <div class="flex items-center">
                        <input id="checkbox-2" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                        <label for="checkbox-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree to the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>
                    </div> --> 
                </div>
            </div>
        </div>       
        
        <div class="flex-grow flex flex-col justify-start items-center rounded-lg"  id="form-step-3" style="display: none;">
            <div class="w-2/3 text-gray-500 mb-2">Choose which fields the user should fill in to join your event. </div>
            <ul class="grid gap-5 w-2/3 grid-cols-2">
                <li>
                    <input type="checkbox" id="fullnameInput" value="" class="hidden peer">
                    <label for="fullnameInput" class="inline-flex justify-between items-center p-5 w-full rounded-lg border-2 cursor-pointer hover:text-white border-gray-700 peer-checked:border-green-600 text-gray-400 peer-checked:text-white bg-gray-800 hover:bg-green-700 hover:border-green-500">
                        <div class="flex justify-start items-center gap-5">
                            <i class="fas fa-fw fa-user text-xl"></i>
                            <div>
                                <div class="w-full text-lg font-semibold">Full Name</div>
                                <div class="w-full text-sm">Add First and last name input.</div>
                            </div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="checkbox" id="emailInput" value="" class="hidden peer">
                    <label for="emailInput" class="inline-flex justify-between items-center p-5 w-full rounded-lg border-2 cursor-pointer hover:text-white border-gray-700 peer-checked:border-green-600 text-gray-400 peer-checked:text-white bg-gray-800 hover:bg-green-700 hover:border-green-500">                           
                        <div class="flex justify-start items-center gap-5">
                            <i class="fas fa-fw fa-at text-xl"></i>
                            <div>
                                <div class="w-full text-lg font-semibold">E-mail</div>
                                <div class="w-full text-sm">Add input for E-mail.</div>
                            </div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="checkbox" id="phoneInput" value="" class="hidden peer">
                    <label for="phoneInput" class="inline-flex justify-between items-center p-5 w-full rounded-lg border-2 cursor-pointer hover:text-white border-gray-700 peer-checked:border-green-600 text-gray-400 peer-checked:text-white bg-gray-800 hover:bg-green-700 hover:border-green-500">
                        <div class="flex justify-start items-center gap-5">
                            <i class="fas fa-fw fa-mobile text-xl"></i>
                            <div>
                                <div class="w-full text-lg font-semibold">Phone number</div>
                                <div class="w-full text-sm">Add input for Phone number</div>
                            </div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="checkbox" id="descriptionInput" value="" class="hidden peer">
                    <label for="descriptionInput" class="inline-flex justify-between items-center p-5 w-full rounded-lg border-2 cursor-pointer hover:text-white border-gray-700 peer-checked:border-green-600 text-gray-400 peer-checked:text-white bg-gray-800 hover:bg-green-700 hover:border-green-500">
                        <div class="flex justify-start items-center gap-5">
                            <i class="fas fa-fw fa-text text-xl"></i>
                            <div>
                                <div class="w-full text-lg font-semibold">Description</div>
                                <div class="w-full text-sm">Add input for Description.</div>
                            </div>
                        </div>
                    </label>
                </li>
            </ul>
        </div>

        <div class="flex-grow rounded-lg bg-yellow-800" id="form-step-4" style="display: none;"></div>
        
        <div class="w-full flex justify-center items-center gap-5">
            <div id="btnPrev" class="text-white flex justify-center items-center gap-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 cursor-pointer">
                {{ __('Previous') }}
            </div>    
            <div id="btnNext" class="text-white flex justify-center items-center gap-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 cursor-pointer">
                {{ __('Next') }}
            </div>    
        </div>
    </div>
</x-app-layout>
