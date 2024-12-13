<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::resource('auth', AuthController::class);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);


Route::middleware(['auth:sanctum', 'taskLog'])->group(function () {
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('task', TaskController::class);
});
