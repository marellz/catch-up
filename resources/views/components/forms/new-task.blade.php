@props(['categories' => collect([]), 'contacts' => collect([])])

<form action="{{ route('tasks.create') }}" method="POST">
    @csrf
    <div class="bg-white shadow rounded p-5">
        <h1 class="text-xl font-semibold mb-6">Add a new task</h1>

        <div class="grid lg:grid-cols-2 gap-4">

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
                <input type="date" class="px-2 py-1.5 rounded w-full border border-grey" name="due_date"
                    value="{{ now()->addDay() }}" id="task-due" />
            </div>

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
