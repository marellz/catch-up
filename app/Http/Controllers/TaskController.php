<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tasks = Task::orderBy('complete')->get();

        $categories = Category::all();

        // ddd($tasks);

        return view('welcome', [
            'tasks' => $tasks,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return redirect()->route('tasks');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string',
            'description' => 'string|nullable',
            'duration_number' => 'nullable|integer',
            'duration_units' => 'nullable|integer'
        ]);

        $duration = $request->duration_number * $request->duration_units;

        $request->merge([
            'task_status_id' => 1,
            'due_date' => now()->addMinutes($duration ?? 60),
            'duration' => $duration,
        ]);

        $query = $request->only([
            'name',
            'description',
            'task_status_id',
            'due_date',
            'duration',
        ]);

        // return response($query);

        $task = Task::create($query);

        if ($request->has('categories')) {
            foreach ($request->categories as $category) {
                TaskCategory::create([
                    'task_id' => $task->id,
                    'category_id' => $category,
                ]);
            }
        }

        

        return redirect()->route('tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        return redirect()->route('tasks');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $complete = $request->task_status_id == 3;

        $task->update([
            'complete' => $complete, 
            'task_status_id' => $request->task_status_id,
        ]);

        return redirect()->route('tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //

        $task->delete();

        return redirect()->route('tasks');
    }
}
