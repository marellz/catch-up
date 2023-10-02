<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    //

    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
      $this->middleware('auth');  
    }

    public function index()
    {
        //

        $tasks = Auth::user()->tasks->sortBy('complete');
        $assigned = Auth::user()->assigned;
        $contacts = User::all();

        $categories = Category::all();

        return view('dashboard', [
            'tasks' => $tasks,
            'assigned' => $assigned,
            'categories' => $categories,
            'contacts'  => $contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return redirect()->route('dash.tasks');
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
            'user_id' => Auth::id(),
            'status_id' => 1,
            'due_date' => now()->addMinutes($duration ?? 60),
            'duration' => $duration,
        ]);

        $query = $request->only([
            'name',
            'description',
            'status_id',
            'due_date',
            'duration',
            'user_id',
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

        if ($request->has('assignees')) {
            foreach ($request->assignees as $assignee) {
                TaskUser::create([
                    'user_id'=>$assignee,
                    'task_id' => $task->id
                ]);

                // send notifications!
            }
        }


        return redirect()->route('dash.tasks');
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
        return redirect()->route('dash.tasks');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $update = $request->only(['status_id']);

        $task->update($update);

        return redirect()->route('dash.tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //

        TaskUser::where('task_id', $task->id)->delete();

        $task->delete();

        return redirect()->route('dash.tasks');
    }

}
