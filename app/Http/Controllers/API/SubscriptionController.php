<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Subscription\StoreRequest;
use App\Http\Requests\API\Subscription\UpdateRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscriptionService;
use App\Traits\JsonResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class SubscriptionController extends Controller
{
    use JsonResponseHelper;

    private SubscriptionService $subscriptionService;

    /**
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function store(User $user, StoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->safe()->only(['renewal_at']);

            $subscription = $this->subscriptionService->store(user: $user, data: $data);

            DB::commit();

            return $this->respondSuccess(
                message: 'Abonelik oluşturuldu',
                data: $subscription
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError(
                message: 'Bir hatayla karşılaştık.',
                data: [
                    'exception' => $exception->getMessage()
                ]
            );
        }
    }

    public function update(User $user, Subscription $subscription, UpdateRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->safe()->only(['renewal_at']);

            $this->subscriptionService->update(user: $user, subscription: $subscription, data: $data);

            DB::commit();

            return $this->respondSuccess(
                message: 'Abonelik güncellendi',
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError(
                message: 'Bir hatayla karşılaştık.',
                data: [
                    'exception' => $exception->getMessage()
                ]
            );
        }
    }

    public function delete(User $user, Subscription $subscription): JsonResponse
    {
        try {
            DB::beginTransaction();

            $this->subscriptionService->delete(user: $user, subscription: $subscription);

            DB::commit();

            return $this->respondSuccess(
                message: 'Abonelik silindi',
            );
        } catch (Throwable $exception) {
            DB::rollBack();

            return $this->respondError(
                message: 'Bir hatayla karşılaştık.',
                data: [
                    'exception' => $exception->getMessage()
                ]
            );
        }
    }
}
