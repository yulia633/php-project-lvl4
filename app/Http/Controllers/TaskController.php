<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
     /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $tasks = Task::orderBy('id', 'desc')->paginate(5);
        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('tasks.create', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            ['name' => 'required|unique:tasks',
            'status_id' => 'required',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',],
            $messages = ['unique' => __('validation.The task name has already been taken')]
        );

        $user = Auth::user();
        $task = $user->tasks()->make();
        $task->fill($data);
        $task->save();

        flash(__('tasks.Task has been added successfully'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate(
            ['name' => 'required|unique:tasks',
            'status_id' => 'required',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',],
            $messages = ['unique' => __('validation.The task name has already been taken')]
        );

        $task->update($data);
        $task->save();
        flash(__('tasks.Task has been updated successfully'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        flash(__('tasks.Task has been deleted successfully'))->success();
        return redirect()
            ->route('tasks.index');
    }
}
