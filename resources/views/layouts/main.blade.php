@extends('layouts.base')

@section('body')
   <x-layout.header />
    <main class="flex-auto bg-light-alt">
        @yield('content')
    </main>
    <footer class="bg-light-blue py-4 lg:py-10 px-4">
        <div class="container mx-auto">
            <p>Made by Dave. 2023.</p>
        </div>
    </footer>
@endsection
