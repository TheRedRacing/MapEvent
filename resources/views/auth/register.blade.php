<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="text-white text-lg mb-1 font-medium title-font">Register</h2>
            <!-- FirstName and lastname -->
            <div class="flex justify-between items-start gap-4">
                <div>
                    <x-input-label for="firstname" :value="__('Firstname')" />

                    <x-text-input id="firstname" class="block mt-1 w-full" 
                                    type="text" 
                                    name="firstname" 
                                    :value="old('firstname')" 
                                    required autofocus />

                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="lastname" :value="__('Lastname')" />

                    <x-text-input id="lastname" class="block mt-1 w-full" 
                                    type="text" 
                                    name="lastname" 
                                    :value="old('lastname')" 
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
                                :value="old('username')" 
                                required />

                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="flex justify-between items-center gap-4 mt-4">
                <div>
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
