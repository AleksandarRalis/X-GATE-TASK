<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('projects', [ProjectController::class, 'store'])->name('storeProject');
Route::get('projects', [ProjectController::class, 'indexJson']);
Route::get('projects/filter/{due_date}', [ProjectController::class, 'filterProjectsByDueDate'])->name('filterProjects');


Route::post('categories', [CategoryController::class, 'store'])->name('storeCategory');
Route::get('categories', [CategoryController::class, 'indexJson']);

Route::post('tasks', [TaskController::class, 'store'])->name('storeTasks');
Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks/mark-complete', [TaskController::class, 'markCompleted'])->name('markCompleted');
Route::get('tasks/filter/{category_id}/{status}', [TaskController::class, 'filterByCategoryAndStatus'])->name('filterTasks');

