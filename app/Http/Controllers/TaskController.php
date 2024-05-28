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
        return Auth::user()->tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();
        Auth::user()->tasks->create($request->all());

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

        return $task;
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
