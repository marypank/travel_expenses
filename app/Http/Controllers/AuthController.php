<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {}

    public function login(LoginRequest $request)
    {
        return response([
            'data' => $this->authService->login($request->validated()),
            'message' => ''
        ]);

    }

    public function register(RegisterRequest $request)
    {
        return response([
            'data' => $this->authService->register($request->validated()),
            'message' => ''
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response('')->setStatusCode(204);
    }
}
