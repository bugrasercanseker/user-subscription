<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transaction\StoreRequest;
use App\Models\User;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use App\Traits\JsonResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionController extends Controller
{
    use JsonResponseHelper;

    private TransactionService $transactionService;
    private SubscriptionService $subscriptionService;

    /**
     * @param SubscriptionService $subscriptionService
     * @param TransactionService $transactionService
     */
    public function __construct(SubscriptionService $subscriptionService, TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->subscriptionService = $subscriptionService;
    }

    public function store(User $user, StoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            /**
             * If we should add month to subscription
             */
            /*
            $subscription = $this->subscriptionService->find($request->get('subscription_id'));
            $data = ['renewal_at' => $subscription->renewal_at->addMonth()];

            // Add 1 month to subscription
            $this->subscriptionService->update(user: $subscription->user, subscription: $subscription, data: $data);

            // Create Transaction
            $this->transactionService->store(user: $subscription->user, data: ['price' => $request->get('price')]);
            */

            /**
             * Else
             */
            $data = $request->safe()->only(['subscription_id', 'price']);

            $transaction = $this->transactionService->store(user: $user, data: $data);

            DB::commit();

            return $this->respondSuccess(
                message: 'Ödeme oluşturuldu',
                data: $transaction
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
