<?php

namespace App\Repositories\Song;

use App\Models\Song;
use App\Repositories\Song\SongRepositoryInterface;

class SongRepository implements SongRepositoryInterface
{
    public function create(array $data)
    {
        return Song::create($data);
    }

    public function getPerStatus(string $status, int $page, int $limit)
    {
        $total = Song::where('status', $status)->count();

        $songs = Song::where('status', $status)
            ->orderBy('views', 'desc')
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        return [
            'status' => true,
            'total' => $total,
            'data' => $songs,
            'page' => $page,
            'limit' => $limit,
        ];
    }

    public function findAll(string $status)
    {
        $songs = Song::where('status', $status)
            ->orderBy('views', 'desc')
            ->get();

        return $songs;
    }

    public function update($id, $status)
    {
        $song = Song::findOrFail($id);
        $song->status = $status;
        $song->save();

        return $song;
    }

    public function delete($id)
    {
        return Song::destroy($id);
    }

    public function findById($id)
    {
        return Song::where("youtube_id", $id)->first();
    }
}
