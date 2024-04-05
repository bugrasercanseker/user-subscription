<?php

namespace App\Interfaces;

use App\Models\Subscription;

interface PaymentProviderInterface
{
    public function pay(Subscription $subscription): bool;
}
