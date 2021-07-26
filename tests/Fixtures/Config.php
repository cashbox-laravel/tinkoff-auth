<?php

namespace Tests\Fixtures;

use Helldar\Contracts\Cashier\DTO\Config as Contract;

class Config implements Contract
{
    protected $terminal_key;

    protected $token;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getDriver(): string
    {
        // TODO: Implement getDriver() method.
    }

    public function getRequest(): string
    {
        // TODO: Implement getRequest() method.
    }

    public function getClientId(): ?string
    {
        return $this->terminal_key;
    }

    public function getClientSecret(): ?string
    {
        return $this->token;
    }
}
