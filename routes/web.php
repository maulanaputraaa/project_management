<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('project', ProjectController::class);
    Route::get('/task/my-tasks', [TaskController::class, 'myTasks'])
        ->name('task.myTasks');
    Route::resource('task', TaskController::class);
    Route::get('/task/{task}/submit', [SubmitController::class, 'create'])
        ->name('submit.create');
    Route::post('/task/{task}/submit', [SubmitController::class, 'store'])
        ->name('submit.store');
    Route::resource('user', UserController::class);
    // Route::resource('submit', SubmitController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
