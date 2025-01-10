<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $result = $this->userService->getAll();

        return response()->json($result, $result['status'] ? 200 : 400);
    }

    public function store(Request $request)
    {
        $result = $this->userService->createUser($request);

        return response()->json($result, $result['status'] ? 201 : 500);
    }
}
