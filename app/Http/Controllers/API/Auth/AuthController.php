<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\JsonResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuthController extends Controller
{
    use JsonResponseHelper;

    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->safe()->only(['name', 'email', 'password']);

            $this->authService->register(data: $data);

            DB::commit();

            return $this->respondSuccess(
                message: 'Kayıt işlemi tamamlandı, giriş yapabilirsiniz.'
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError(
                message: 'Bir hatayla karşılaştık',
                data: [
                    'exception' => $exception->getMessage()
                ]
            );
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            DB::beginTransaction();
            $credentials = $request->safe()->only(['email', 'password']);

            $token = $this->authService->login(credentials: $credentials);

            DB::commit();

            return $this->respondSuccess(
                message: 'Giriş yapıldı',
                data: $token
            );
        } catch (AuthenticationException $exception) {
            DB::rollBack();

            return $this->respondError(
                message: $exception->getMessage()
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError(
                message: 'Bir hatayla karşılaştık',
                data: [
                    'exception' => $exception->getMessage()
                ]
            );
        }
    }
}
