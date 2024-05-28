<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->filterTasks();
        Log::info('TaskController@index', ['tasks' => $tasks]);
        return Inertia::render('Dashboard', [
            "tasks" => $tasks,
            "completedTasks" => Auth::user()->tasks->where('status', 'completed')->count(),
            "pendingTasks" => Auth::user()->tasks->where('status', 'pending')->count(),
            "backlogTasks" => Auth::user()->tasks->where('status', 'backlog')->count(),
            // subtasks
            "substats" => [
                "pendingHighest" => Auth::user()->tasks->where('status', 'pending')->where('priority', 'highest')->count(),
                "pendingMedium" => Auth::user()->tasks->where('status', 'pending')->where('priority', 'medium')->count(),
                "pendingLowest" => Auth::user()->tasks->where('status', 'pending')->where('priority', 'lowest')->count(),
            ]
        ]);
    }

    private function filterTasks()
    {
        $priority = request('priority');
        $status = request('status');

        if ($search = request('search')) {
            log::info('search', ['search' => $search]);
            return $this->searchQuery($search);
        }


        if (!$priority && !$status) {
            return $this->filterByNone();
        }

        if ($status != 'all' && $priority == 'all') {
            return $this->filterByStatus($status);
        }
        if ($status == 'all' && $priority != 'all') {
            return $this->filterByPriority($priority);
        }
        if ($status != 'all' && $priority != 'all') {
            return $this->filterByStatusAndPriority($status, $priority);
        }
        return $this->filterByNone();
    }

    private function filterByStatus($status)
    {
        return auth()->user()->tasks->where('status', $status);
    }
    private function filterByPriority($priority)
    {
        return auth()->user()->tasks->where('priority', $priority);
    }
    private function filterByStatusAndPriority($status, $priority)
    {
        return auth()->user()->tasks->where('status', $status)->where('priority', $priority);
    }

    private function filterByNone()
    {
        return Auth::user()->tasks->groupBy('status');
    }

    // return search results
    private function searchQuery($search)
    {
        return Auth::user()->tasks->where('title', 'like', "$search%");
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
        Log::info('TaskController@update', ['task' => $task, 'request' => $request]);
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
