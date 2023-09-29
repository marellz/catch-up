@extends('layouts.base')

@section('body')
    <header class="py-4">
        <div class="container mx-auto px-4 flex items-center">
            <div class="flex-auto">
                <a href="{{ route('home') }}" class="font-bold text-dark-blue">Catchup.</a>
            </div>
            <div class="flex space-x-4 lg:pr-10">
                @auth
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        @php
                            $user = Auth::user()
                        @endphp

                        <span>
                            {{ $user->name }}
                        </span>
                    </div>

                    <form action="{{ route('auth.logout' )}}" method="POST">
                        @csrf
                        <button type="submit" class="font-light hover:text-red">Logout</button>
                    </form>
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
