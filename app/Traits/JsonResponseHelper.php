<?php

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseHelper
{
    public function respondSuccess(?string $title = null, ?string $message = null, array|Arrayable|JsonSerializable|null $data = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'success',
            'title' => $title ?: 'İşlem Başarılı',
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondInfo(?string $title = null, ?string $message = null, array|Arrayable|JsonSerializable|null $data = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'info',
            'title' => $title ?: 'Bilgi',
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondWarning(?string $title = null, ?string $message = null, array|Arrayable|JsonSerializable|null $data = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'warning',
            'title' => $title ?: 'Uyarı!',
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondValidation(?string $title = null, ?string $message = null, array|Arrayable|JsonSerializable|null $errors = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'error',
            'title' => $title ?: 'Eksik veya hatalı bilgi',
            'message' => $message ?: 'Lütfen eksik veya hatalı bilgileri kontrol edin.',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function respondError(?string $title = null, ?string $message = null, array|string|Arrayable|JsonSerializable|null $data = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'error',
            'title' => $title ?: 'Bir hatayla karşılaştık',
            'message' => $message,
            'data' => $data
        ], Response::HTTP_BAD_REQUEST);
    }

    public function respondUnAuthenticated(?string $title = null, ?string $message = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'error',
            'title' => $title ?: 'Giriş yapmanız gerekiyor',
            'message' => $message,
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function respondForbidden(?string $title = null, ?string $message = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'error',
            'title' => $title ?: 'Yetkiniz yok',
            'message' => $message,
        ], Response::HTTP_FORBIDDEN);
    }

    public function respondNotFound(?string $title = null, ?string $message = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => 'error',
            'title' => $title ?: 'Bulunamadı',
            'message' => $message,
        ], Response::HTTP_NOT_FOUND);
    }

    private function apiResponse($data, $code = 200): JsonResponse
    {
        return response()->json(data: $data, status: $code);
    }
}
