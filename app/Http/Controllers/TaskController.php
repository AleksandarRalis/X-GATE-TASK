<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = $this->indexJson();
        $projects = Project::all();
        $categories = Category::all();
        return view('tasks', ['tasks' => $tasks, 'projects' => $projects, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,completed',
        ]);

        $task = Task::create($request->all());

        return redirect()->route('tasksIndex');
    }

    public function indexJson()
    {

        return  Task::all();

    }

    public function markCompleted(Request $request)
    {
        $task = Task::findOrFail($request->get('task_id'));
        $task->status = 'completed';
        $task->save();

        return redirect()->route('tasksIndex');
    }

    public function filterByCategoryAndStatus($category_id, $status)
    {

        $tasks = Task::with(['category', 'project'])->where('category_id', $category_id)->where('status', $status)->get();

        return response()->json($tasks);

    }
}
