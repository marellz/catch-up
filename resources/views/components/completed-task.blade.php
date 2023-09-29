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
            <button
                class="p-1 border border-transparent rounded hover:border hover:border-blue-alt hover:text-blue-alt">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </button>
        </form>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @method('delete')
            @csrf
            <button class="p-1 border border-transparent rounded hover:text-red hover:border-red">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </form>

    </div>
</div>
