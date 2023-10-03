@extends('layouts.main')

@section('title') Register @endsection
@section('content')
    <x-container>
        <div class="flex justify-center">
            <div class="w-[500px] p-5 bg-white rounded shadow">
                <h1 class="text-4xl font-medium">
                    Register
                </h1>

                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div class="mt-10 space-y-4">
                        <x-form-input label="Name" name="name" />
                        <x-form-input label="Email" type="email" name="email" />
                        <x-form-input label="Password" type="password" name="password" />
                        <x-form-input label="Confirm password" type="password" name="password_confirmation" />
                        <x-button class="w-full">
                            <span>Register</span>
                        </x-button>
                        
                        <p class="block text-sm">Already have an account? <a class=" text-blue-alt" href="{{ route('login')}}">Log in</a> </p>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
@endsection