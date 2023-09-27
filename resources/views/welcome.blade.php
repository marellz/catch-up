@extends('layouts.main')

@section('content')
    <div class="container mx-auto md:py-20">
        <div class="grid md:grid-cols-6 xl:grid-cols-8">
            <div class="md:col-span-4 md:col-start-2 xl:col-span-4 xl:col-start-3">

                {{-- title --}}
                <div>
                    <h1 class="text-3xl">
                        Hello Dave.
                    </h1>
                    <p class="mt-2 text-">All your tasks.</p>
                </div>

                <form action="{{ route('tasks.create') }}" method="POST">
                    @csrf
                    <div class="bg-white shadow rounded p-5 mt-10">
                        <h1 class="text-xl font-semibold mb-6">Add a new task</h1>

                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex flex-col col-span-2">
                                <label for="task-name" class="mb-2">Task name</label>
                                <input type="text" class="p-2 rounded w-full border  {{ $errors->has('name') ? 'border-red': 'border-grey'}}" name="name"
                                    id="task-name" />

                                @if ($errors->has('name'))
                                    <span class="text-red mt-1 text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <label for="task-duration" class="mb-2">Duration</label>
                                <select id="task-duration" class="p-2 w-full border bg-white border-grey rounded"
                                    name="duration">
                                    <option value="10">10 minutes</option>
                                    <option value="20">20 minutes</option>
                                    <option value="30">30 minutes</option>
                                    <option value="45">45 minutes</option>
                                    <option value="60">1 hour</option>
                                    <option value="120">2 hours</option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label for="task-due" class="mb-2">Due date</label>
                                <input type="date" class="px-2 py-1.5 rounded w-full border border-grey" name="due_date"
                                    value="{{ now()->addDay() }}" id="task-due" />
                            </div>

                            <div class="flex flex-col col-span-2">
                                <label for="task-description" class="mb-2">Description</label>
                                <textarea class="p-2 w-full border border-grey rounded" name="description" id="task-description"></textarea>
                            </div>

                            <div class="col-span-2 text-end">
                                <button type="submit"
                                    class="inline-flex items-center py-2 px-5 bg-dark-blue text-white rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span>
                                        Create task
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="space-y-3 mt-10">
                    <h1 class="text-xl font-semibold mb-6">Upcoming tasks</h1>
                    
                    {{-- tasks loop --}}
                    @foreach ($tasks as $task)
                        <div
                            class="bg-white shadow p-5 rounded border-l-4 {{ $task->complete ? 'border-green' : 'border-light-blue' }} ">
                            <div class="flex flex-col lg:flex-row">
                                <div class="flex items-center flex-wrap flex-auto space-x-4">
                                    <h1 class="text-xl font-medium">{{ $task->name }}</h1>
                                    <div class="inline-flex items-center space-x-2 text-blue-alt">
                                        {{-- clock --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>
                                            {{ $task->duration }} min
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center space-x-2 text-blue-alt">

                                        {{-- calendar --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>
                                        <span>
                                            {{ $task->due_date }}
                                        </span>
                                    </div>
                                </div>

                                <div class="ml-auto flex space-x-2 py-4 md:py-0">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @method('patch')
                                        <input type="hidden" name="complete" value="{{ $task->complete ? '0' : '1' }}" />
                                        @csrf
                                        <button
                                            class="p-2 bg-light hover:bg-dark-blue hover:text-green flex items-center space-x-1 rounded">
                                            {{-- checkmark --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                            <span class="hidden lg:inline">Completed</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="p-2 bg-light hover:text-red flex items-center space-x-1 rounded">

                                            {{-- trash --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            <span class="hidden lg:inline">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="opacity-50">
                                {{ $task->description ?? 'No description' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
