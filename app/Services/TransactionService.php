<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;

class TransactionService
{
    private TransactionRepository $repository;

    public function get(User $user)
    {
        return $this->repository->get(user: $user);
    }

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(User $user, array $data): Transaction
    {
        return $this->repository->store(user: $user, data: $data);
    }
}
