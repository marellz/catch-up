@props(['categories' => collect([]), 'contacts' => collect([])])

<form action="{{ route('tasks.create') }}" method="POST">
    @csrf

    {{-- {{ $errors->count() }} --}}
    <div class="bg-white shadow rounded p-5" x-data="{ open: true, more: true }">

        <button type="button" class="flex items-center w-full text-left" @click="open = !open">
            <h1 class="flex-auto text-xl font-semibold">Add a new task</h1>
            <x-icons.plus />
        </button>

        <div class="grid lg:grid-cols-2 gap-4 mt-6" x-show="open">

            <x-form-input label="Task name" name="name" class="lg:col-span-2" />

            <div class="flex flex-col">
                <label for="task-duration" class="mb-2">Duration</label>
                <div class="flex border border-grey rounded overflow-hidden">
                    <input type="number" id="task-duration" name="duration_number" value="10"
                        class="p-2 flex-none w-1/2" />
                    <select id="task-duration" class="p-2 border-l bg-white border-grey flex-auto" name="duration_units"
                        value="minutes">
                        <option value="1">minutes</option>
                        <option value="60">hours</option>
                        <option value="1440">days</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <label for="task-due" class="mb-2">Due date</label>
                <div class="flex border border-grey rounded overflow-hidden">
                    <input type="date" class="px-2 py-1.5 rounded w-full" name="due_date"
                        value="{{ today()->addDay()->format('Y-m-d') }}" id="task-due" />

                    <select class="p-2 border-l bg-white border-grey flex-auto outline-none" name="due_date_hours">
                        @foreach (range(1, 12) as $item)
                            <option value="{{ $item }}" @if($item == 8) selected @endif>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                    <select class="p-2 border-l bg-white border-grey flex-auto outline-none" name="due_date_minutes">
                        <option value="00">
                            00
                        </option>
                        @foreach (range(1, 5) as $item)
                            <option value="{{ $item * 10 }}">
                                {{ $item * 10 }}
                            </option>
                        @endforeach
                    </select>
                    <select class="p-2 border-l bg-white border-grey flex-auto outline-none" name="due_date_meridiem">
                        @foreach (['AM', 'PM'] as $item)
                            <option value="{{ $item }}">
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-5" x-show="open">
            <button type="button" class="flex items-center text-left space-x-4 text-dark-blue" @click="more=!more">
                <h1 class="flex-auto text-lg font-semibold ">More details</h1>
                <x-icons.chevron-down />
            </button>
        </div>

        <div class="grid lg:grid-cols-2 gap-4 mt-6 pb-2" x-show="more && open">
            <div class="">
                <x-dropdown label="Categories">
                    @foreach ($categories as $option)
                        <div class="flex px-2 hover:bg-grey">
                            <input type="checkbox" name="categories[]" id="task-category-{{ $option->id }}"
                                value={{ $option->id }} />
                            <label class="py-2 flex-auto px-2" for="task-category-{{ $option->id }}">
                                {{ $option->name }}</label>
                        </div>
                    @endforeach
                </x-dropdown>

            </div>

            <div class="">
                <x-dropdown label="Assignees">
                    @foreach ($contacts as $option)
                        <div class="flex px-2 hover:bg-grey">
                            <input type="checkbox" name="assignees[]" id="task-assignee-{{ $option->id }}"
                                value={{ $option->id }} />
                            <label class="py-2 flex-auto px-2" for="task-assignee-{{ $option->id }}">
                                {{ $option->name }}</label>
                        </div>
                    @endforeach
                </x-dropdown>
            </div>

            <div class="flex flex-col lg:col-span-2">
                <label for="task-description" class="mb-2">Description</label>
                <textarea class="p-2 w-full border border-grey rounded" name="description" id="task-description"></textarea>
            </div>
        </div>

        <div class="p-4" x-show="open">
            <div class="text-end lg:col-span-2">
                <x-button>
                    <x-icons.plus />
                    <span>
                        Create task
                    </span>
                </x-button>
            </div>
        </div>
    </div>
</form>
