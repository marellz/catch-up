@extends('layouts.main')

@section('content')
    <div class="container mx-auto md:py-20">
        {{-- title --}}
        <div class="p-4">
            <h1 class="text-3xl">
                Hello Dave.
            </h1>
            <p class="mt-2 opacity-50">All your tasks.</p>
        </div>
        <div class="grid lg:grid-cols-3 gap-10 mb-10">
            <div class="lg:col-span-2 px-4">
                <form action="{{ route('tasks.create') }}" method="POST">
                    @csrf
                    <div class="bg-white shadow rounded p-5">
                        <h1 class="text-xl font-semibold mb-6">Add a new task</h1>

                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex flex-col col-span-2">
                                <label for="task-name" class="mb-2">Task name</label>
                                <input type="text"
                                    class="p-2 rounded w-full border  {{ $errors->has('name') ? 'border-red' : 'border-grey' }}"
                                    name="name" id="task-name" />

                                @if ($errors->has('name'))
                                    <span class="text-red mt-1 text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="flex flex-col">
                                <label for="task-duration" class="mb-2">Duration</label>
                                <div class="flex border border-grey rounded overflow-hidden">
                                    <input type="number" id="task-duration" name="duration_number" value="10"
                                        class="p-2 flex-none w-1/2" />
                                    <select id="task-duration" class="p-2 border-l bg-white border-grey flex-auto"
                                        name="duration_units" value="minutes">
                                        <option value="1">minutes</option>
                                        <option value="60">hours</option>
                                        <option value="1440">days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="task-due" class="mb-2">Due date</label>
                                <input type="date" class="px-2 py-1.5 rounded w-full border border-grey" name="due_date"
                                    value="{{ now()->addDay() }}" id="task-due" />
                            </div>

                            <div class="flex flex-col col-span-2">
                                <label class="mb-2">Category</label>

                                <div class="flex flex-wrap">

                                    @foreach ($categories as $option)
                                        <div class="mb-2 mr-2">
                                            <input type="checkbox" name="categories[]"
                                                id="task-category-{{ $option->id }}" value={{ $option->id }} />
                                            <label for="task-category-{{ $option->id }}">{{ $option->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <select id="task-category" class="p-2 w-full border bg-white border-grey rounded">
                                    <option value="null">none</option>
                                    <option value={{ $option->id }}>
                                        {{$option->name}}
                                    </option>
                                </select> --}}
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
                    @forelse ($tasks->where('complete', false) as $task)
                        <div
                            class="bg-white shadow p-5 rounded border-l-4 @if($task->task_status_id == 1) border-light-blue @elseif($task->task_status_id == 2) border-blue-alt @endif ">
                            <div class="flex items-start xl:items-center">
                                <div class="flex flex-col xl:flex-row items-start xl:items-center xl:flex-auto">
                                    <div class="flex space-x-3 items-center">
                                        <h1 class="text-xl font-medium">{{ $task->name }}</h1>
                                        <div class="">
                                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                @method('patch')
                                            
                                                @if($task->task_status_id < 3)
                                                    <input type="hidden" name="task_status_id" value="{{ $task->task_status_id + 1}}" />
                                                @endif

                                                @csrf
                                                @php
                                                    $current = $task->task_status_id;
                                                    
                                                    if ($current == 1) {
                                                        $states = collect(['Pending', 'Begin']);
                                                        $classes = 'hover:bg-blue-alt hover:border-blue-alt focus:bg-blue-alt focus:border-blue-alt';
                                                    } // click this and form will mark as in_progress
                                                    
                                                    else if ($current == 2) {
                                                        $states = collect(['In progress', 'Complete']);
                                                        $classes = 'border-blue-alt bg-blue-alt text-white hover:bg-green hover:border-green focus:bg-green focus:border-green';
                                                    }
                                                    
                                                    else {
                                                        $states = collect([]);
                                                        $classes = '';
                                                    }
                                                    
                                                @endphp

                                                <button
                                                    class="overflow-hidden group border h-6 rounded-full inline-flex flex-col hover:text-white focus:outline-none  focus:text-white text-sm active:bg-transparent {{ $classes}}"
                                                    @if ($task->task_status_id === 3) disabled @endif>
                                                    <div
                                                        class="px-3 flex flex-col h-4 w-full transform transition group-hover:-translate-y-6 group-focus:-translate-y-6 -mt-0.5">
                                                        @foreach ($states as $item)
                                                            <span class=" text-center h-6 leading-6">{{ $item }}</span>
                                                        @endforeach
                                                    </div>
                                                </button>

                                            </form>
                                        </div>
                                       
                                    </div>
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 mt-2 xl:ml-4 xl:mt-0">
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
                                </div>
                                <div class="flex space-x-2 md:py-0 ml-auto transform -translate-y-2">

                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button
                                            class="p-2 text-red hover:bg-red hover:text-white flex items-center space-x-1 rounded">

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

                            @if ($task->categories->count())
                                <div class="py-4 md:py-2 flex flex-wrap">
                                    @foreach ($task->categories as $category)
                                        <span
                                            class="px-3 mb-2 mr-2 text-sm bg-light text-green rounded-full font-medium border-dark-blue">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            @if($task->description)
                            <div>
                                <p class="opacity-50 pt-2">
                                    {{ $task->description }}
                                </p>
                            </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-10 border rounded border-grey">
                            <h1 class="text-center text-dark-blue">All caught up!</h1>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="bg-white shadow rounded p-4 mx-4">
                <h1 class="text-xl font-semibold mb-6">Completed tasks</h1>

                @forelse ($tasks->where('complete', true) as $task)
                    <div class="border-b border-b-grey flex items-start">
                        <div class="flex-auto p-3">
                            <h1 class="font-medium text-green">
                                {{ $task->name }}
                            </h1>
                            <div class="flex opacity-50">
                                <p class="text-sm">
                                    {{ $task->due_date }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-2 opacity-40 hover:opacity-100">
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="task_status_id" value="1" />
                                <button
                                    class="p-1 border border-transparent rounded hover:border hover:border-blue-alt hover:text-blue-alt">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="p-1 border border-transparent rounded hover:text-red hover:border-red">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-light-blue border rounded">
                        <p> Empty! </p>
                    </div>
                @endforelse

            </div>
        </div>
    @endsection
