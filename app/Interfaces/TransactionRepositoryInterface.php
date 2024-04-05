<?php

namespace App\Interfaces;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function get(User $user): Collection;
    public function store(User $user, array $data): Transaction;
}
