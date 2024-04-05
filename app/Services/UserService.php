<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $repository;
    private SubscriptionService $subscriptionService;
    private TransactionService $transactionService;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository, SubscriptionService $subscriptionService, TransactionService $transactionService)
    {
        $this->repository = $repository;
        $this->subscriptionService = $subscriptionService;
        $this->transactionService = $transactionService;
    }

    public function get(User $user): array
    {
        return [
            'user' => $user,
            'subscriptions' => $this->subscriptionService->get(user: $user),
            'transactions' => $this->transactionService->get(user: $user)
        ];
    }

    public function create(array $data): User
    {
        return $this->repository->store(data: $data);
    }
}
