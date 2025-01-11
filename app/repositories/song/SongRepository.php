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

    public function getPerStatus(string $status)
    {
        return Song::where('status', $status)->get();
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
        return Song::where("youtube_id", $id);
    }
}
