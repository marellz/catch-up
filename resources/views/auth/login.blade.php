@extends('layouts.main')

@section('title')
    Login
@endsection

@section('content')
    <div class="container mx-auto md:py-20">
        <div class="flex justify-center">
            <div class="w-[500px] p-5 bg-white rounded shadow">
                <h1 class="text-4xl font-medium">
                    Login
                </h1>

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="mt-10 space-y-4">
                        <x-form-input label="Email" type="email" name="email" />
                        <x-form-input label="Password" type="password" name="password" />

                        <x-button class="w-full">
                            <span>Login</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
