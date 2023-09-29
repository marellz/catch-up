@extends('layouts.main')

@section('title') Register @endsection
@section('content')
@section('content')
    <div class="container mx-auto md:py-20">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@endsection