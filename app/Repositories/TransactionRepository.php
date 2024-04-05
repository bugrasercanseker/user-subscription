<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function get(User $user): Collection
    {
        return $user->transactions()->get();
    }

    public function store(User $user, array $data): Transaction
    {
        return $user->transactions()->create($data);
    }
}
