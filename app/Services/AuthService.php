<?php

namespace App\Services;

use App\DTOs\Auth\LoginDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct() {}

    public function login(LoginDTO $dto)
    {
        if (!Auth::attempt([
            'username' => $dto->username,
            'password' => $dto->password
        ])) {
            throw ValidationException::withMessages(
                ['login' => 'Las credenciales introducidas son incorrectas.']
            );
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
