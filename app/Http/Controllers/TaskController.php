<?php

namespace App\Http\Controllers;

use App\Models\task\Task;
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
        $tasks = Task::all();
        return view('welcome', ['tasks' => $tasks]);
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
    public function store(Request $request) : RedirectResponse
    {
        //

        $request->validate([
            'name' => 'required|string',
            'description' => 'string|nullable',
        ]);

        $request->merge([
            'task_status_id' => 1,
        ]);
        $query = $request->only([
            'name',
            'description',
            'task_status_id',
            'due_date',
            'duration',
        ]);

        // return response($query);

        Task::create($query);

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

        $task->update(['complete' => $request->complete]);
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
