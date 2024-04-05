<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class AuthService implements AuthServiceInterface
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(array $data): User
    {
        return $this->userService->create(data: $data);
    }

    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): array
    {
        // Attempt to authenticate user
        if (auth()->attempt($credentials)) {
            return $this->createToken(auth()->user());
        } else {
            throw new AuthenticationException('Bilgileriniz eşleşmiyor');
        }
    }

    private function createToken($user): array
    {
        // Generate New Token
        $token = $user->createToken('API');

        return [
            'token' => [
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ]
        ];
    }
}
