@props(['task'])

<div
    class="bg-white shadow p-5 rounded border-l-4 @if ($task->status_id == 1) border-light-blue @elseif($task->status_id == 2) border-blue-alt @endif ">
    <div class="flex items-start lg:items-center">
        <div class="flex flex-col xl:flex-row items-start xl:items-center xl:flex-auto">
            <div class="flex space-x-3 items-center">
                <h1 class="text-xl font-medium">{{ $task->name }}</h1>
                <div class="">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @method('patch')

                        @if ($task->status_id < 3)
                            <input type="hidden" name="status_id" value="{{ $task->status_id + 1 }}" />
                        @endif

                        @csrf
                        @php
                            $current = $task->status_id;
                            
                            if ($current == 1) {
                                $states = collect(['Pending', 'Begin']);
                                $classes = 'hover:bg-blue-alt hover:border-blue-alt focus:bg-blue-alt focus:border-blue-alt';
                            }
                            
                            // click this and form will mark as in_progress
                            elseif ($current == 2) {
                                $states = collect(['In progress', 'Complete']);
                                $classes = 'border-blue-alt bg-blue-alt text-white hover:bg-green hover:border-green focus:bg-green focus:border-green';
                            }
                            
                        @endphp

                        <button
                            class="overflow-hidden group border h-6 rounded-full inline-flex flex-col hover:text-white focus:outline-none  focus:text-white text-sm active:bg-transparent {{ $classes }}"
                            @if ($task->status_id === 3) disabled @endif>
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
                    <x-icons.clock />
                    <span>
                        {{ $task->duration }} min
                    </span>
                </div>
                <div class="inline-flex items-center space-x-2 text-blue-alt">

                    {{-- calendar --}}
                    <x-icons.calendar />
                    <span>
                        {{ $task->due_date }}
                    </span>
                </div>
            </div>
        </div>
        <div class="flex space-x-2 md:py-0 ml-auto transform -translate-y-2 lg:-translate-y-0">
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @method('delete')
                @csrf
                <x-button color="text-red hover:bg-red hover:text-white">

                    {{-- trash --}}
                    <x-icons.trash />
                    <span class="hidden lg:inline">Delete</span>
                </x-button>
            </form>
        </div>

    </div>

    @if ($task->categories->count())
        <div class="py-4 md:py-2 flex flex-wrap">
            @foreach ($task->categories as $category)
                <x-partials.category-tag>
                    {{ $category->name }}
                </x-partials.category-tag>
            @endforeach
        </div>
    @endif
    @if ($task->description)
        <div>
            <p class="opacity-50 pt-2">
                {{ $task->description }}
            </p>
        </div>
    @endif

    @if($task->assignees->count())
    <div class="my-5">
        <div class="bg-light px-4 pt-3 rounded">
            <h1 class="mb-3"> Assigned to </h1>
            <div class="flex flex-col md:flex-row md:flex-wrap">
                @foreach ($task->assignees as $user)
                    <div class="flex items-center space-x-2 me-3 mb-3 text-dark-blue">
                        <x-icons.user />
    
                        <span class="">
                            {{ $user->name }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
