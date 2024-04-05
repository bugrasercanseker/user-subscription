<?php

namespace App\Console\Commands;

use App\Factories\PaymentAdapterFactory;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class RenewSubscriptionCommand extends Command
{
    protected $signature = 'renew:subscription';

    protected $description = 'Command description';
    private SubscriptionService $subscriptionService;
    private TransactionService $transactionService;

    /**
     * @param SubscriptionService $subscriptionService
     * @param TransactionService $transactionService
     */
    public function __construct(SubscriptionService $subscriptionService, TransactionService $transactionService)
    {
        parent::__construct();
        $this->subscriptionService = $subscriptionService;
        $this->transactionService = $transactionService;
    }

    public function handle(): void
    {
        $subscriptions = $this->subscriptionService->getShouldRenew();

        $this->withProgressBar($subscriptions, function (Subscription $subscription) {
            try {
                DB::beginTransaction();
                $paymentAdapter = PaymentAdapterFactory::create(user: $subscription->user);

                $status = $paymentAdapter->pay($subscription);

                if ($status) {
                    $data = ['renewal_at' => $subscription->renewal_at->addMonth()];

                    // Add 1 month to subscription
                    $this->subscriptionService->update(user: $subscription->user, subscription: $subscription, data: $data);

                    // Create Transaction
                    $this->transactionService->store(user: $subscription->user, data: ['price' => 100]);
                } else {
                    // Delete Subscription

                    /**
                     * We can add more features. For example, try x time and after that cancel subscription etc.
                     */
                    $this->subscriptionService->delete(user: $subscription->user, subscription: $subscription);
                }

                DB::commit();
            } catch (Throwable $exception) {
                DB::rollBack();
                $this->error($exception->getMessage());
            }
        });
    }
}
