<?php

namespace App\Interfaces;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface SubscriptionRepositoryInterface
{
    public function get(User $user): Collection;

    public function getShouldRenew(): Collection;
    public function store(User $user, array $data): Subscription;
    public function update(User $user, Subscription $subscription, array $data): void;
    public function delete(User $user, Subscription $subscription): void;
}
