<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }
}
