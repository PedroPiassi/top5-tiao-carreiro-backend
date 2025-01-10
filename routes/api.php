<?php

use App\Http\Controllers\AuthController;
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
});
