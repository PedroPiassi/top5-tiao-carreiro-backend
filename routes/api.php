<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::post('/login', [AuthController::class, "login"])->name("login");

// Rotas Privadas
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('logout/{user}', [UserController::class, 'logout']);
});
