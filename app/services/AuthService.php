<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {
    }

    public function login(string $email, string $password)
    {
        $user = $this->authRepository->login($email, $password);

        if ($user) {
            $token = $user->createToken('api-token')->plainTextToken;

            return [
                'status' => true,
                'token' => $token,
                'user' => $user,
            ];
        }

        return [
            'status' => false,
            'message' => 'E-mail ou senha inválidos.',
        ];
    }

    public function logout($user)
    {
        try {
            $user->tokens()->delete();

            return [
                'status' => true,
                'message' => 'Deslogado com sucesso.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Falha ao efetuar logout.',
            ];
        }
    }
}
