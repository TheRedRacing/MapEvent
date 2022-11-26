<nav class="bg-gray-950 h-screen pb-2 pt-5 px-2 flex flex-col w-nav hover:w-navhover transition-all ease-linear">                
    <!-- Logo -->
    <x-application-logo-inline/>
    <hr>
    <ul class="flex flex-col justify-between" style="height:calc(100vh - 6vh);">
        <div>
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-fw fa-home-alt text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Home') }}</span>
            </x-nav-link>
            
            <x-nav-link :href="route('newevents')" :active="request()->routeIs('newevents')">
                <i class="fas fa-fw fa-calendar-plus text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Create Event') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('events')" :active="request()->routeIs('events')">
                <i class="fas fa-fw fa-calendar-star text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Events') }}</span>
            </x-nav-link>            

            <x-nav-link :href="route('explore')" :active="request()->routeIs('explore')">
                <i class="fas fa-fw fa-compass text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Explore') }}</span>
            </x-nav-link>

            <x-nav-link>
                <i class="fas fa-fw fa-inbox text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Inbox') }}</span>
            </x-nav-link>
            
            <hr>
            
            <x-nav-link :href="route('news')" :active="request()->routeIs('news')">
                <i class="fas fa-fw fa-newspaper text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.News') }}</span>
            </x-nav-link>
            
            <x-nav-link :href="('https://github.com/TheRedRacing/CarDistrict-Meet/issues')" target="_blank">
                <i class="fas fa-fw fa-exclamation-triangle text-xl" style="min-width: 60px;"></i>
                <span class="text-base font-normal overflow-hidden whitespace-nowrap transition-opacity">{{ __('navigation.Report Bug') }}</span>
            </x-nav-link>
        </div>
        @if (Auth::user())
        <div>        
            <x-nav-link :href="route('profile', Auth::user()->username)" :active="request()->routeIs('profile')">
                <i class="fas fa-fw fa-user text-xl" style="min-width: 60px;"></i>
                <span class="overflow-hidden whitespace-nowrap transition-opacity">
                    {{ Auth::user()->username }}
                </span>
            </x-nav-link>
           
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link onclick="event.preventDefault();
                            this.closest('form').submit();">
                    <i class="fas fa-fw fa-sign-out text-xl" style="min-width: 60px;"></i>
                    <span class="overflow-hidden whitespace-nowrap transition-opacity">
                        {{ __('navigation.Log Out') }}
                    </span>
                </x-nav-link>
            </form>            
        </div>
        @else
        <div>        
            <x-nav-link :href="route('login')">
                <i class="fas fa-fw fa-sign-in text-xl" style="min-width: 60px;"></i>
                <span class="overflow-hidden whitespace-nowrap transition-opacity">
                    {{__('welcome.Log in')}}
                </span>
            </x-nav-link>
           
            <x-nav-link :href="route('register')">
                <i class="fas fa-fw fa-user text-xl" style="min-width: 60px;"></i>
                <span class="overflow-hidden whitespace-nowrap transition-opacity">
                    {{__('welcome.Register')}}
                </span>
            </x-nav-link>         
        </div>
        @endif
    </ul>
</nav>
