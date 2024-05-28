<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priority = request('priority');
        $status = request('status');

        $tasks = Auth::user()->tasks;

        if ($priority && $priority !== 'all') {
            $tasks->where('priority', $priority);
        }

        if ($status && $status !== 'all') {
            $tasks->where('status', $status);
        }

        $filteredTasks = $tasks->get();

        return $filteredTasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
        ]);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request->validated();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Auth::user()->tasks->delete($task);
    }

    public function search(Request $request, $search)
    {
        $tasks = Auth::user()->tasks->where('title', 'like', "%$search%")->get();
        return $tasks;
    }
}
