@extends('layouts.base')

@section('body')
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

                            <span>
                                {{ $user->name }}
                            </span>

                            <x-icons.chevron-down class="w-4" />
                        </button>

                        {{-- menu --}}
                        <div class="flex flex-col border border-grey bg-white min-w-full shadow rounded py-2 absolute top-full transform translate-y-2"
                            x-show="open">
                            <a href="#profile" class="flex items-center space-x-2 px-4 py-2 hover:bg-dark-blue hover:text-white w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>

                                <span>
                                    Profile
                                </span>
                            </a>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center space-x-2 px-4 py-2 hover:bg-red hover:text-white w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>
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
    <main class="flex-auto bg-light-alt">
        @yield('content')
    </main>
    <footer class="bg-light-blue py-4 lg:py-10 px-4">
        <div class="container mx-auto">
            <p>Made by Dave. 2023.</p>
        </div>
    </footer>
@endsection
