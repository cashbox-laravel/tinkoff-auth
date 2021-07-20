<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\DTO;

use Helldar\Support\Concerns\Makeable;

class Client
{
    use Makeable;

    protected $client_id;

    protected $client_secret;

    protected $hash = true;

    public function hash(bool $hash = true): Client
    {
        $this->hash = $hash;

        return $this;
    }

    public function clientId(string $client_id): Client
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function clientSecret(string $client_secret): Client
    {
        $this->client_secret = $client_secret;

        return $this;
    }

    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    public function hasHash(): bool
    {
        return $this->hash;
    }
}
