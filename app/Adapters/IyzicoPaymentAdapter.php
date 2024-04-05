<?php

namespace App\Adapters;

use App\Interfaces\PaymentProviderInterface;
use App\Models\Subscription;

class IyzicoPaymentAdapter implements PaymentProviderInterface
{
    public function pay(Subscription $subscription): bool
    {
        // Handle Payment
        return true;
    }
}
