<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::post('/login', [AuthController::class, "login"])->name("login");
Route::post('/register', [UserController::class, "store"]);

// Rotas Privadas
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('logout/{user}', [AuthController::class, 'logout']);

    Route::post('/song', [SongController::class, 'store']);
    Route::get('/songs/{status}', [SongController::class, 'findAll']);
    Route::get('/song/{status}', [SongController::class, 'getPerStatus']);
    Route::put('/song/approve/{id}', [SongController::class, 'approve']);
    Route::put('/song/reject/{id}', [SongController::class, 'reject']);
    Route::delete('/song/{id}', [SongController::class, 'delete']);
});
