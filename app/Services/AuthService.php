<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Handle user login.
     *
     * @param array $credentials
     * @return array
     * @throws ValidationException
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'token' => $user->createToken('auth-token')->plainTextToken,
            'user' => $user,
        ];
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return bool
     */
    public function logout(Request $request): bool
    {
        return $request->user()->currentAccessToken()->delete();
    }

    /**
     * Get authenticated user.
     *
     * @param Request $request
     * @return User|null
     */
    public function getAuthenticatedUser(Request $request): ?User
    {
        return $request->user();
    }
}