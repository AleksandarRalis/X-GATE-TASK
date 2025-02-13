<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects', [ProjectController::class, 'index'])->name('projectsIndex');
Route::get('categories', [CategoryController::class, 'index'])->name('categoriesIndex');
Route::get('tasks', [TaskController::class, 'index'])->name('tasksIndex');

