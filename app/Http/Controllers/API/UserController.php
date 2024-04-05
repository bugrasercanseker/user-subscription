<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use App\Traits\JsonResponseHelper;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use JsonResponseHelper;

    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get(User $user): JsonResponse
    {
        $user = $this->userService->get(user: $user);

        return $this->respondSuccess(
            data: $user
        );
    }
}
