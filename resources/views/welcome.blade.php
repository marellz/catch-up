@extends('layouts.main')

@section('title')
    Home
@endsection
@section('content')
    <div class="container mx-auto py-20 px-5">
        <div class="grid xl:grid-cols-3">
            <div class="xl:col-span-2 py-20 flex flex-col items-center">
                <h1 class="font-bold text-4xl lg:text-[4vw] text-center">Welcome to <span class="text-blue-alt">Catchup.</span> </h1>
                <p class="text-xl opacity-70 leading-7 lg:max-w-[40vw] text-center mt-10">Lorem ipsum dolor sit amet
                    consectetur
                    adipisicing elit. Culpa, suscipit quo repudiandae cumque libero dolores voluptatibus numquam obcaecati
                    adipisci, optio, autem magni nihil explicabo aut animi dolorem perferendis molestias consectetur.</p>

                <div class="flex mt-10 relative justify-center">
                    @auth
                        <a href="{{ route('dash.tasks') }}">
                            <x-button class="space-x-2">
                                <span>Go to my tasks</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z"
                                        clip-rule="evenodd" />
                                </svg>

                            </x-button>
                        </a>
                    @else
                        <a href="{{ route('register') }}">
                            <x-button>Get Started</x-button>
                        </a>
                    @endauth
                </div>
            </div>

            <div class="py-10 text-center">
                <img src="{{ Vite::asset('resources/illustrations/undraw-choose.svg') }}" class="w-96 inline" />
            </div>
        </div>
    </div>
@endsection
