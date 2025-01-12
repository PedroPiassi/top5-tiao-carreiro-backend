<?php

namespace App\Repositories\Song;

interface SongRepositoryInterface
{
    public function create(array $data);
    public function getPerStatus(string $status, int $page, int $limit);
    public function findAll(string $status);
    public function update($id, $status);
    public function delete($id);
    public function findById($id);
}
