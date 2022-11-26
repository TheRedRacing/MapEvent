<x-app-layout>
    <form action="" method="POST">
        @csrf

        <div class="grid grid-cols-3 gap-5 pt-6 px-4">
            <div class="col-span-3 flex justify-between items-center gap-5">
                <div class="text-2xl text-white">Setting Page</div>
                @if (session()->has('alert'))
                    <x-alert :message="session('alert.message')" :level="session('alert.type')" />
                @endif

                @if (Auth::user()->username == "TheRedRacing")
                    <a href="{{ route('admin') }}" class="inline-flex items-center gap-2 bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base text-white mt-4 md:mt-0">
                        Admin Page                                
                    </a>
                @endif
            </div>
            <div class="col-span-1 flex flex-col gap-5 text-white">
                <div class="h-fit bg-gray-800 p-5 rounded-md">
                    <div class="text-xl">Picture</div>
                    <div class="w-20 h-20 mt-4 rounded-full bg-blue-500"></div>
                    <div class="mt-4 flex justify-start gap-5">
                        <x-primary-button>
                            {{ __('Upload') }}
                        </x-primary-button>
                    </div>
                </div>

                <div class="h-fit bg-gray-800 p-5 rounded-md">
                    <div class="text-xl">Language & Country</div>
                    <div>
                        <x-input-label for="language" :value="__('Language ( default EN )')" />
                        <select id="language" name="language" autocomplete="language-name" class="border text-base rounded focus:ring-2 focus:ring-indigo-900 focus:border-indigo-500 block w-full p-2.5 bg-gray-1000 border-gray-600 placeholder-gray-400 outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @foreach($language_items as $key => $item)
                            <option value="{{$key}}" {{(Auth::user()->language == $key)? "selected":""}}>{{$item}}</option>                        
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('language')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="country" :value="__('Country')" />
                        <select id="country" name="country" autocomplete="country-name" class="border text-base rounded focus:ring-2 focus:ring-indigo-900 focus:border-indigo-500 block w-full p-2.5 bg-gray-1000 border-gray-600 placeholder-gray-400 outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @foreach($country_items as $key => $item)
                            <option value="{{$key}}" {{(Auth::user()->country == $key)? "selected":""}}>{{$item}}</option>                        
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                </div>               
                
                <div class="h-fit bg-gray-800 p-5 rounded-md flex justify-between gap-5 items-center">
                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-secondary-button>
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
                
            </div>
            <div class="col-span-2 flex flex-col gap-5 text-white">
                <div class="h-fit bg-gray-800 p-5 rounded-md">
                    <div class="text-xl">General information</div>
                    <!-- FirstName and lastname -->
                    <div class="flex justify-between items-start gap-4">
                        <div class="w-full">
                            <x-input-label for="firstname" :value="__('Firstname')" />

                            <x-text-input id="firstname" class="block mt-1 w-full" 
                                            type="text" 
                                            name="firstname" 
                                            :value="Auth::user()->firstname" 
                                            required autofocus />

                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="lastname" :value="__('Lastname')" />

                            <x-text-input id="lastname" class="block mt-1 w-full" 
                                            type="text" 
                                            name="lastname" 
                                            :value="Auth::user()->lastname" 
                                            required />

                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>                
                    </div>

                    <!-- userName -->
                    <div class="mt-4">
                        <x-input-label for="username" :value="__('Username')" />

                        <x-text-input id="username" class="block mt-1 w-full" 
                                        type="text" 
                                        name="username" 
                                        :value="Auth::user()->username" 
                                        required />

                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input id="email" class="block mt-1 w-full" 
                                        type="email" 
                                        name="email" 
                                        :value="Auth::user()->email" 
                                        required />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div class="h-fit bg-gray-800 p-5 rounded-md">
                    <div class="text-xl">Password information</div>
                    <div>
                        <x-input-label for="oldpassword" :value="__('Old Password')" />

                        <x-text-input id="oldpassword" class="block mt-1 w-full" 
                                        type="password" 
                                        name="oldpassword" 
                                        />

                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>
                    <!-- New Password -->
                    
                    <div class="mt-4">
                        <x-input-label for="new_password" :value="__('New Password')" />

                        <x-text-input id="new_password" class="block mt-1 w-full" 
                                        type="password" 
                                        name="new_password"
                                        />

                        <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
