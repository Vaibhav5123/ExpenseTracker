<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'show']);
    Route::put('/me', [UserController::class, 'update']);
    Route::delete('/me', [UserController::class, 'destroy']);

});
