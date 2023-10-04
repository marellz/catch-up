<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskUser;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
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

        $user = Auth::user();
        $tasks = $user->tasks->sortBy('due_date');
        $assigned = $user->assigned;

        foreach (collect([])->merge($tasks)->merge($assigned) as $task) {

            $task->duration = CarbonInterval::minutes($task->duration)->cascade();

            $due = new Carbon($task->due_date);
            $task->due_date = ''.$due->format('Y-m-d, h:i A');
            $task->due_date_diff = $due->diffForHumans();
            $task->overdue = now() > $due;

        }

        $contacts = User::all();

        $categories = Category::all();
        $data = [
            'tasks' => $tasks,
            'assigned' => $assigned,
            'categories' => $categories,
            'contacts' => $contacts,
            'user' => $user,
        ];

        return view('dashboard', $data);
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
            'duration_units' => 'nullable|integer',
            'due_date' => 'date|nullable',
        ]);

        $duration = $request->duration_number * $request->duration_units;

        $date = new Carbon($request->due_date);

        $due_date = $date
            ->hour($request->due_date_meridiem == 'PM' ? intval($request->due_date_hours) + 12  : $request->due_date_hours)
            ->minute($request->due_date_minutes);

        $request->merge([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'due_date' => $due_date,
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
                    'user_id' => $assignee,
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
