<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @property-read string $client_id
 * @property-read string $client_secret
 * @property-read string $payment_id
 * @property-read string $sum
 * @property-read string $currency
 * @property-read string $created_at
 */
class ModelEloquent extends Model
{
    public $timestamps = false;

    protected function getClientIdAttribute(): string
    {
        return TestCase::TERMINAL_KEY;
    }

    protected function getClientSecretAttribute(): string
    {
        return TestCase::TOKEN;
    }

    protected function getPaymentIdAttribute(): string
    {
        return TestCase::PAYMENT_ID;
    }

    protected function getSumAttribute(): float
    {
        return TestCase::SUM;
    }

    protected function getCurrencyAttribute(): string
    {
        return TestCase::CURRENCY;
    }

    protected function getCreatedAtAttribute(): Carbon
    {
        return Carbon::parse(TestCase::CREATED_AT);
    }
}
