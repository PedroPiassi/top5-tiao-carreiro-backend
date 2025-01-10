<?php

namespace App\Http\Controllers;

use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    private $songService;

    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }

    public function store(Request $request)
    {
        $result = $this->songService->createSong($request->only('url'));

        return response()->json($result, $result['status'] ? 201 : 404);
    }

    public function approve($id)
    {
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $result = $this->songService->approveSong($id);

        return response()->json($result, $result['status'] ? 200 : 404);
    }

    public function reject($id)
    {
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $result = $this->songService->rejectSong($id);

        return response()->json($result, $result['status'] ? 200 : 404);
    }

    public function delete($id)
    {
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $result = $this->songService->deleteSong($id);

        return response()->json($result, $result['status'] ? 200 : 404);
    }

}
