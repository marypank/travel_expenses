<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // todo: create service for handling
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt(['name' => $data['name'], 'password' => $data['password']])) {
            return response([
                'data' => '',
                'message' => 'Login or password incorrect.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);

    }

    public function register(RegisterRequest $request)
    {
        // todo: remake, i dont like what each method returns. make baseController with data and message (if error)
        $data = $request->validated();

        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();

        // todo: or empty response
        return response('')->setStatusCode(204);
    }
}
