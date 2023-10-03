@extends('layouts.main')

@section('title')
    Password reset
@endsection

@section('content')
    <x-container>
        <div class="flex justify-center">
            <div class="w-[500px] p-5 bg-white rounded shadow">
                <h1 class="text-4xl font-medium">
                    Password reset
                </h1>
                <form action="{{ route('auth.password.store') }}" method="POST">
                    @csrf
                    <div class="mt-10 space-y-4">

                        @if($errors->has('email'))
                            <p class="text-sm my-4 text-red">
                                {{$errors->first('email')}}
                            </p>
                        @endif

                        <input type="hidden" name="token" value="{{ $token }}"/>
                        <input type="hidden" name="email" value="{{ request()->query('email') }}"/>
                        <x-form-input label="Password" type="password" name="password" required :errors="$errors" />
                        <x-form-input label="Confirm password" type="password" name="password_confirmation" required :errors="$errors" />

                        <x-button class="w-full">
                            <span>Reset password</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
@endsection
