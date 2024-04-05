<?php

namespace App\Factories;

use App\Adapters\IyzicoPaymentAdapter;
use App\Adapters\StripePaymentAdapter;
use App\Enums\PaymentProvider;
use App\Models\User;
use http\Exception\InvalidArgumentException;

class PaymentAdapterFactory
{
    public static function create(User $user)
    {
        return match ($user->payment_provider) {
            PaymentProvider::IYZICO => new IyzicoPaymentAdapter(),
            PaymentProvider::STRIPE => new StripePaymentAdapter(),
            default => throw new InvalidArgumentException('Invalid Payment Provider'),
        };
    }
}
