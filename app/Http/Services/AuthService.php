<?php

namespace App\Http\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    // todo: refactor/remake service

    public function login(array $data): array
    {
        if (!$this->checkGuard($data['name'], $data['password'])) {
            throw new Exception('Login or password incorrect.'); // todo: custom
        }

        /** @var User $user */
        $user = Auth::user();

        return [
            'user' => new UserResource($user),
            'token' => $this->createToken($user),
        ];
    }

    public function register(array $data): array
    {
        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'user' => new UserResource($user),
            'token' => $this->createToken($user),
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    private function checkGuard(string $name, string $password): bool
    {
        return Auth::guard('web')->attempt(['name' => $name, 'password' => $password]);
    }

    private function createToken(User $user, string $name = 'main'): string
    {
        return $user->createToken($name)->plainTextToken;
    }
}