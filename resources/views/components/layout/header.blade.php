 <header class="py-4">
     <div class="container mx-auto px-4 flex items-center">
         <div class="flex-auto">
             <a href="{{ route('home') }}" class="font-bold text-dark-blue">Catchup.</a>
         </div>
         <div class="flex space-x-4 lg:pr-10">
             @auth

                 {{-- dd --}}
                 <div class="flex flex-col relative" x-data="{ open: false }" @click.away="open=false">

                     {{-- trigger --}}
                     <button type="button" class="flex items-center space-x-2" @click="open = !open">

                         <x-icons.user class="opacity-50" />

                         @php
                             $user = Auth::user();
                         @endphp

                         <span class="hidden lg:inline">
                             {{ $user->name }}
                         </span>

                         <x-icons.chevron-down class="w-4" />
                     </button>

                     {{-- menu --}}
                     <div class="flex flex-col border border-grey bg-white min-w-[150px] shadow rounded py-2 absolute top-full transform translate-y-2 right-0"
                         x-show="open">
                         <a href="#profile"
                             class="flex items-center space-x-2 px-4 py-2 hover:bg-dark-blue hover:text-white w-full">
                            <x-icons.user />

                             <span>
                                 Profile
                             </span>
                         </a>
                         <form action="{{ route('auth.logout') }}" method="POST">
                             @csrf
                             <button type="submit"
                                 class="flex items-center space-x-2 px-4 py-2 hover:bg-red hover:text-white w-full">
                                 <x-icons.logout />
                                 <span>
                                     Logout
                                 </span>
                             </button>
                         </form>
                     </div>

                 </div>
             @else
                 @php
                     $routes = ['login', 'register'];
                 @endphp

                 @foreach ($routes as $route)
                     <a class="py-2 border-b border-b-transparent capitalize @if (request()->is($route)) border-b-blue-alt @endif"
                         href="{{ route($route) }}">{{ $route }}</a>
                 @endforeach
             @endauth
         </div>
     </div>
 </header>
