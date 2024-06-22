<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::get('websites', [WebsiteController::class, 'index']);
Route::get('websites/search', [WebsiteController::class, 'search']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('websites', [WebsiteController::class, 'store']);
    Route::post('websites/{id}/vote', [VoteController::class, 'vote']);
    Route::delete('websites/{id}', [WebsiteController::class, 'destroy'])->middleware('isAdmin');
    
    Route::post('categories', [CategoryController::class, 'store'])->middleware('isAdmin');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->middleware('isAdmin');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->middleware('isAdmin');

    Route::post('logout', [AuthController::class, 'logout']);
});