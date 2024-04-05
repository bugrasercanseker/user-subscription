<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $data): User;

    public function login(array $credentials): array;
}
