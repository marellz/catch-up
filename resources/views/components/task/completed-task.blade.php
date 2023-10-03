@props(['task'])

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
            <input type="hidden" name="status_id" value="1" />
            <x-button class="!p1" color=" hover:border-blue-alt hover:text-blue-alt">
                <x-icons.undo />
            </x-button>
        </form>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @method('delete')
            @csrf
            <x-button class="!p1" color="hover:text-red hover:border-red">
                <x-icons.trash />
            </x-button>
        </form>

    </div>
</div>
