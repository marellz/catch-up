@extends('layouts.main')

@section('title')
    Home
@endsection
@section('content')
    <x-container>
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
                                <x-icons.arrow-long-left />

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
    </x-container>
@endsection
