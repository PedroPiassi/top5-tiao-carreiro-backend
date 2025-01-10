<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        $users = $this->userRepository->getAll();

        if ($users) {
            return [
                'status' => true,
                'users' => $users,
            ];
        }

        return [
            'status' => false,
            'message' => 'Nenhum usuário encontrado.',
        ];
    }

    public function createUser($data)
    {
        try {
            $user = $this->userRepository->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password, ["round" => 12]),
            ]);

            return [
                'status' => true,
                'message' => 'Usuário registrado com sucesso.',
                'user' => $user,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Erro ao registrar o usuário.',
            ];
        }
    }
}
