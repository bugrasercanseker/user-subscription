<?php

namespace App\Repositories;

use App\Interfaces\SubscriptionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    private Subscription $subscription;

    /**
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function get(User $user): Collection
    {
        return $user->subscriptions()->get();
    }

    public function getShouldRenew(): Collection
    {
        return $this->subscription->with('user')->where('renewal_at', today())->get();
    }

    public function find(int $id): Subscription
    {
        return $this->subscription->findOrFail($id);
    }

    public function store(User $user, array $data): Subscription
    {
        return $user->subscriptions()->create($data);
    }

    public function update(User $user, Subscription $subscription, array $data): void
    {
        $user->subscriptions()->findOrFail($subscription->id)->update($data);
    }

    public function delete(User $user, Subscription $subscription): void
    {
        $user->subscriptions()->findOrFail($subscription->id)->delete();
    }
}
