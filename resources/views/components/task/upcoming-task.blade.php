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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        {{ $task->duration }} min
                    </span>
                </div>
                <div class="inline-flex items-center space-x-2 text-blue-alt">

                    {{-- calendar --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span class="hidden lg:inline">Delete</span>
                </x-button>
            </form>
        </div>

    </div>

    @if ($task->categories->count())
        <div class="py-4 md:py-2 flex flex-wrap">
            @foreach ($task->categories as $category)
                <span class="px-3 mb-2 mr-2 text-sm bg-light text-green rounded-full font-medium border-dark-blue">
                    {{ $category->name }}
                </span>
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
    <div class="my-2">
        <div class="flex">
            @foreach ($task->assignees as $user)
                <div class="flex items-center space-x-2 me-3 mb-3 text-dark-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="">
                        {{ $user->name }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
