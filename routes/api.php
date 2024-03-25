<?php

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->group( function () {
    Route::get("/user", [AdminController::class, 'user']);
    Route::post('/logout', [AdminController::class, 'logout']);
});

Route::post('/login', [AdminController::class, 'login']);
Route::post('/signup', [AdminController::class, 'signup']);
