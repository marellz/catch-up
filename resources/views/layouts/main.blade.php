@extends('layouts.base')

@section('body')

<header class="py-4">
    <div class="container mx-auto">
        <a href="{{ route('tasks')}}" class="font-bold text-dark-blue">Catchup.</a>
    </div>
</header>
<main class="flex-auto bg-light-alt">
    @yield('content')
</main>
<footer class="bg-light-blue py-10 ">
    <div class="container mx-auto">
        <p>Made by Dave. 2023.</p>
    </div>
</footer>
    
@endsection