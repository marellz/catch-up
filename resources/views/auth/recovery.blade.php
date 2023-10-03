@extends('layouts.main')

@section('title')
    Password recovery
@endsection

@section('content')
    <x-container>
        <div class="flex justify-center">
            <div class="w-[500px] p-5 bg-white rounded shadow">
                <h1 class="text-4xl font-medium">
                    Password recovery
                </h1>

                <form action="{{ route('auth.password.email') }}" method="POST">
                    @csrf
                    <div class="mt-10 space-y-4">
                        <x-form-input label="Email" type="email" name="email" required />
                        
                        @if (session()->has('status'))
                            <p class="text-blue-alt"> {{ session('status') }} </p>
                        @endif
                        <x-button class="w-full">
                            <span>Send email</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
@endsection
