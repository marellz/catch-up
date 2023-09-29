@extends('layouts.main')

@section('title')
    Home
@endsection
@section('content')

<div class="container mx-auto py-20">
    <div class="flex flex-col items-center">
        <h1 class="font-bold text-4xl lg:text-[4vw]">Welcome to <span class="text-blue-alt">Catchup.</span> </h1>
        <p class="text-xl opacity-70 leading-7 lg:max-w-[40vw] text-center mt-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, suscipit quo repudiandae cumque libero dolores voluptatibus numquam obcaecati adipisci, optio, autem magni nihil explicabo aut animi dolorem perferendis molestias consectetur.</p>

        <div class="flex mt-10">
            <a href="{{ route('register')}}">
                <x-button>Get Started</x-button>
            </a>
        </div>
    </div>
</div>
@endsection
