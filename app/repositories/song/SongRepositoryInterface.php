<?php

namespace App\Repositories\Song;

interface SongRepositoryInterface
{
    public function create(array $data);
    public function update($id, $status);
    public function delete($id);
    public function findById($id);
}
