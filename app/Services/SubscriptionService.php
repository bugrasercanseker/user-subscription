<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;
use App\Repositories\SubscriptionRepository;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionService
{
    private SubscriptionRepository $repository;

    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(User $user)
    {
        return $this->repository->get(user: $user);
    }

    public function getShouldRenew(): Collection
    {
        return $this->repository->getShouldRenew();
    }

    public function find(int $id): Subscription
    {
        return $this->repository->find($id);
    }

    public function store(User $user, array $data): Subscription
    {
        return $this->repository->store(user: $user, data: $data);
    }

    public function update(User $user, Subscription $subscription, array $data): void
    {
        $this->repository->update(user: $user, subscription: $subscription, data: $data);
    }

    public function delete(User $user, Subscription $subscription): void
    {
        $this->repository->delete(user: $user, subscription: $subscription);
    }
}
