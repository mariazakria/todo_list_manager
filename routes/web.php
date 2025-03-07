<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/',[TaskController::class, 'index'])->name('todos.index');
    Route::get('/create', [TaskController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TaskController::class, 'store'])->name('todos.store');
    Route::get('/todos/{id}/edit', [TaskController::class, 'edit'])->name('todos.edit');
    Route::put('/todos/{task}', [TaskController::class, 'update'])->name('todos.update');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('todos.destroy');
});


require __DIR__.'/auth.php';
