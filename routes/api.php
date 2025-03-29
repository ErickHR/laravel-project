<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {

  Route::post('/login', [LoginController::class, 'authenticate']);

  Route::middleware(['auth.unauthenticated','auth:sanctum', 'check.permissions'])->group(function () {
    Route::get('/test', [LoginController::class, 'authenticate']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::apiResource('/task', TaskController::class);
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/role/{role}', [RoleController::class, 'show']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::put('/role/{role}', [RoleController::class, 'update']);
    Route::delete('/role/{role}', [RoleController::class, 'destroy']);

    Route::get('/logout', [LoginController::class, 'logout']);
  });
  
});

Route::any('/{any}', function () {
  return response()->json([
      'message' => 'Not Found',
      'status' => 404
  ], 404);
})->where('any', '.*');

