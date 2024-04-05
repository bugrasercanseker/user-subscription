<?php

namespace App\Adapters;

use App\Interfaces\PaymentProviderInterface;
use App\Models\Subscription;

class StripePaymentAdapter implements PaymentProviderInterface
{

    public function pay(Subscription $subscription): bool
    {
        // Handle Payment
        return true;
    }
}
