<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;


Route::middleware('auth.apikey')->group(function () {
    // Routes for CRUD operations of tasks
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
    Route::put('/tasks/{id}/status', [TaskController::class, 'updateStatus']);

    // Routes for CRUD operations of employee
    Route::get('/employees', [EmployeeController::class, 'index']);
});
?>
