@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@php
    {{ $user = Auth::user(); }}
@endphp
@section('content')
    <div class="container mx-auto md:py-20">
        {{-- title --}}
        <div class="p-4">
            <h1 class="text-3xl">
                Hello {{ $user->name }}.
            </h1>
            <p class="mt-2 opacity-50">All your tasks.</p>
        </div>
        <div class="grid lg:grid-cols-3 gap-10 mb-10 items-start">
            <div class="lg:col-span-2 px-4">
                <x-new-task :categories="$categories" />

                <div class="space-y-3 mt-10">
                    <h1 class="text-xl font-semibold mb-6">Upcoming tasks</h1>

                    {{-- tasks loop --}}
                    @forelse ($tasks->where('status_id','<', 3) as $task)
                        <x-upcoming-task :task="$task" />
                    @empty
                        <div class="py-10 border rounded border-grey">
                            <h1 class="text-center text-dark-blue">All caught up!</h1>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="bg-white shadow rounded p-4 mx-4">
                <h1 class="text-xl font-semibold mb-6">Completed tasks</h1>

                @forelse ($tasks->where('status_id', 3) as $task)
                    <x-completed-task :task="$task" />
                @empty
                    <div class="py-10 text-center text-light-blue border rounded">
                        <p> Empty! </p>
                    </div>
                @endforelse

            </div>
        </div>
    @endsection