<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = $this->indexJson();
        $dueDates = Project::pluck('due_date');
        return view('projects', ['projects' => $projects, 'dueDates' => $dueDates]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $project = Project::create($request->all());

        return redirect()->route('projectsIndex');
    }

    public function indexJson()
    {

        return Project::all();

    }

    public function filterProjectsByDueDate($due_date)
    {
        $projects = Project::filterProjectsByDueDate($due_date);
        
        return response()->json($projects);
    }
}
