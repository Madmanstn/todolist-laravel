<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

    
Route::get('/', [MyController::class, 'index']);
Route::post('/todos', [MyController::class, 'store'])->name('todos.store');
Route::put('/todos/{todo}/complete', [MyController::class, 'complete'])->name('todos.complete');
Route::put('/todos/{todo}/undo', [MyController::class, 'undo'])->name('todos.undo');
Route::delete('/todos/{todo}', [MyController::class, 'destroy'])->name('todos.destroy');