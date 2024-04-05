<?php

namespace App\Enums;

enum PaymentProvider: string
{
    CASE STRIPE = 'stripe';
    CASE IYZICO = 'iyzico';

    public function getName(): string
    {
        return match ($this) {
            self::STRIPE => 'Stripe',
            self::IYZICO => 'Iyzico',
        };
    }

    public function getId(): int
    {
        return match ($this) {
            self::STRIPE => 'stripe',
            self::IYZICO => 'iyzico',
        };
    }

    public function getBadgeColor(): string
    {
        return match ($this) {
            self::STRIPE => 'primary',
            self::IYZICO => 'dark',
        };
    }
}
