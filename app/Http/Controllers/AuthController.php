<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(Request $request)
    {
        $result = $this->authService->login($request->email, $request->password);

        if ($result['status']) {
            return response()->json($result, 201);
        } else {
            return response()->json($result, 404);
        }
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request->user());

        if ($result['status']) {
            return response()->json($result, 201);
        } else {
            return response()->json($result, 400);
        }
    }
}
