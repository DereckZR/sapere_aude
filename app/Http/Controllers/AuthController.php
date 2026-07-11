<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\DTOs\Auth\LoginDTO;
use App\Http\Requests\auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login()
    {
        return view("auth.login");
    }

    public function verifyLogin(LoginRequest $request)
    {
        $data = $request->validated();
        $dto = new LoginDTO($data);

        $this->authService->login($dto);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
