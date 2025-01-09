<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return response()->json([
            'status' => true,
            'users' => $users,
        ], 201);
    }

    public function logout(User $user)
    {
        try {
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deslogado com sucesso.',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha ao efetuar logout.',
            ], 400);
        }
    }
}
