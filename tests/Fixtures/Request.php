<?php

namespace Tests\Fixtures;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Clientable;
use Helldar\Contracts\Cashier\Auth\Client as ClientContract;
use Helldar\Contracts\Cashier\DTO\Config;
use Helldar\Contracts\Cashier\Resources\Request as RequestContract;
use Helldar\Support\Concerns\Makeable;
use Illuminate\Database\Eloquent\Model;

class Request implements RequestContract
{
    use Makeable;

    protected $config;

    public function __construct(Model $model, Config $config)
    {
        $this->config = $config;
    }

    public function getAuthentication(): ClientContract
    {
        return Clientable::make()
            ->setClientId($this->config->getClientId())
            ->setClientSecret($this->config->getClientSecret());
    }

    public function getUniqueId(bool $every = false): string
    {
        // TODO: Implement getUniqueId() method.
    }

    public function getPaymentId(): string
    {
        // TODO: Implement getPaymentId() method.
    }

    public function getSum(): int
    {
        // TODO: Implement getSum() method.
    }

    public function getCurrency(): string
    {
        // TODO: Implement getCurrency() method.
    }

    public function getCreatedAt(): string
    {
        // TODO: Implement getCreatedAt() method.
    }

    public function getNow(): string
    {
        // TODO: Implement getNow() method.
    }
}
