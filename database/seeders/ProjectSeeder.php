<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create(['name' => 'Project 1', 'description' => 'Description of Project 1', 'due_date' => now()->addDays(10)]);
        Project::create(['name' => 'Project 2', 'description' => 'Description of Project 2', 'due_date' => now()->addDays(20)]);
        Project::create(['name' => 'Project 3', 'description' => 'Description of Project 3', 'due_date' => now()->addDays(30)]);
        Project::create(['name' => 'Project 4', 'description' => 'Description of Project 4', 'due_date' => now()->addDays(40)]);
        Project::create(['name' => 'Project 5', 'description' => 'Description of Project 5', 'due_date' => now()->addDays(50)]);
    }
}
