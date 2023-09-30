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

                        @if (session()->has('password_reset'))
                            <p class="text-blue-alt">Password successfully reset! Log in with your new password.</p>
                        @endif

                        <x-form-input label="Email" type="email" name="email" />
                        <x-form-input label="Password" type="password" name="password" />

                        <x-button class="w-full">
                            <span>Login</span>
                        </x-button>
                        <div class="flex flex-col space-y-3 lg:space-y-0 lg:space-x-2 lg:flex-row !mt-8">
                            <a class="block text-sm text-blue-alt" href="{{ route('register') }}">Create an account</a></p>
                            <a class="block text-sm text-blue-alt lg:border-l lg:pl-4"
                                href="{{ route('recovery') }}">Recover password</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
