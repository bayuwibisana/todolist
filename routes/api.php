<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    
    Route::post('/todos', [TodoController::class, 'store']);
    Route::get('/todos', [TodoController::class, 'index']);

    
    Route::post('/todos/{todo}/checklists', [ChecklistController::class, 'store']);
    Route::delete('/checklists/{checklist}', [ChecklistController::class, 'destroy']);
    Route::get('/todos/{todo}/checklists', [ChecklistController::class, 'index']);

    
    Route::get('/checklists/{checklist}/items', [ItemController::class, 'index']);
    Route::post('/checklists/{checklist}/items', [ItemController::class, 'store']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
    Route::put('/items/{item}', [ItemController::class, 'update']);
    Route::delete('/items/{item}', [ItemController::class, 'destroy']);

});