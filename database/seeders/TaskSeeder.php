<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $projects = Project::all();
        $categories = Category::all();

        for ($i = 1; $i <= 15; $i++) {
            $project = $projects->random();  
            $category = $categories->random(); 
            $due_date = Carbon::now()->addDays(rand(1, 30)); 

            Task::create([
                'project_id' => $project->id,
                'category_id' => $category->id,
                'title' => 'Task ' . $i,
                'description' => 'Description for Task ' . $i,
                'status' => 'pending',
                'due_date' => $due_date,
            ]);
        }
    }
}
