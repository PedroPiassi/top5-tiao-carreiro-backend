<?php

namespace App\Repositories\Auth;

interface AuthRepositoryInterface
{
    public function Login(String $email, String $password);
}
