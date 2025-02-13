<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'due_date'];

    public static function filterProjectsByDueDate($dueDate)
    {
        $projects = Project::all()->where('due_date', $dueDate);

        return $projects;
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
